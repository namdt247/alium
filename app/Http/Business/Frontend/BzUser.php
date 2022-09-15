<?php
/**
 * Created by PhpStorm.
 * User: QuanVH
 * Date: 17/02/2017
 * Time: 21:54 CH
 */

namespace App\Http\Business\Frontend;


use App\Helper\_ApiCode;
use App\Helper\Common;
use App\Http\DAL\DAL_Config;
use App\Jobs\ActivationEmail;
use App\Models\Device_token;
use App\Models\Password_reset;
use App\Models\Social_account;
use App\Models\User;
use App\Notifications\OrderChange;
use Carbon\Carbon;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Contracts\User as ProviderUser;

class BzUser extends BzFrontend
{
    public function postLogin($request){
        $login1 = [
            'user_email' => $request->username,
            'password' => $request->password,
            // 'user_status' => 1,
        ];
        $login2 = [
            'user_phone' => $request->username,
            'password' => $request->password,
            // 'user_status' => 1,
        ];
        if(Auth::attempt($login1,true) || Auth::attempt($login2,true)){
            $user = Auth::user();

            if ($user->user_status == 1){
                $this->saveToken($request->token);
                return _ApiCode::SUCCESS;
            }
            elseif ($user->user_status == 2) {
                //pending active user
                Auth::logout();
                return _ApiCode::USER_PENDING;
            }
            elseif ($user->user_status == 3) {
                Auth::logout();
                return _ApiCode::USER_LOCK;
            }
            else {
                Auth::logout();
                return _ApiCode::LOGIN_FAIL;
            }
        }
        else{
            $userByKey = User::where('user_email',$request->username)
                ->orWhere('user_phone',$request->username)
                ->where('user_status',[DAL_Config::USER_STATUS_PUBLIC,DAL_Config::USER_STATUS_PENDING])
                ->first();
            if ($userByKey && $userByKey->user_id)
                return _ApiCode::WRONG_PASS;
            return _ApiCode::LOGIN_FAIL;
        }
    }

    public function getCodeForgetPass($email){
        $email = strtolower($email);
        if(!$email || $email == '')
            return _ApiCode::LACK_INFO;
        if (!$user = User::where('user_email',$email)
            ->where('user_status','!=',DAL_Config::STATUS_DELETED)->first())
            return _ApiCode::USER_EMAIL_NOT_EXIST;
        elseif($user = User::where('user_email',$email)
            ->where('user_status',3)->first())
            return _ApiCode::USER_LOCK;
        else {
            $code = Common::getUserVerifyCode();
            Password_reset::where('email',$email)->delete();
            Password_reset::create([
                'email' => $email,
                'token' => bcrypt($code),
                'created_at' => Carbon::now()
            ]);
            Mail::send([], [], function ($message) use ($email, $code) {
                $message->from('noreply@alium.vn', 'Alium.vn');
                $message->to($email)->subject('Quên mật khẩu Alium.vn')
                    ->setBody('Mã xác nhận khôi phục mật khẩu của bạn là:' . $code, 'text/html');

            });
            return _ApiCode::SUCCESS;
        }
    }

    public function postForgetPass($request){
        $email = strtolower($request->email);
        $resetRequest = Password_reset::where('email',$email)
            ->orderBy('created_at','desc')->first();
        $bcrypt = new BcryptHasher();
        $tokenCheck = $bcrypt->check($request->code,$resetRequest->token);
        if ($tokenCheck){
            Password_reset::where('email',$email)->delete();
            $user = $this->dal_user->getDetailUser($email);
            $user->password = bcrypt($request->password);
            $user->save();
            return _ApiCode::SUCCESS;
        }
        else{
            //not exits request reset pass with email and code provided
            return _ApiCode::VERIFYCODE_NOT_FOUND;
        }
    }

    public function postChangePass($request){
        $user = Auth::user();
        $oldPassCheck = Hash::check($request->oldPass, $user->password);
        if ($oldPassCheck){
            if ($this->dal_user->updateUser(Auth::user()->user_id,[
                'password' => bcrypt($request->txtPassword)
            ])) {
                Auth::logoutOtherDevices($request->txtPassword);
                return _ApiCode::SUCCESS;
            }
            return _ApiCode::ERROR_UNKNOWN;
        }else {
            return _ApiCode::WRONG_PASS;
        }
    }

    public function postRegister($request){
        $email = strtolower($request->email);
        $data = [
            'user_email' => $email,
            'user_phone' => $request->phone,
            'password' => bcrypt($request->password),
            'user_showName' => $request->name,
            'user_city' => $request->state,
            'user_type' => DAL_Config::TYPE_USER_REGISTER,
            'user_role' => DAL_Config::ROLE_USER_NORMAL,
            'user_status' => DAL_Config::USER_STATUS_PENDING,
            'user_verify' => 0,
            'user_alias' => Common::CreateSlug($request->name),
            'user_verifyCode' => Common::getUserVerifyCode()
        ];
        if($user = User::where('user_email', $email)
            ->where('user_status','!=',DAL_Config::STATUS_DELETED)->first() && 
            $user = User::where('user_phone', $request->phone)
            ->where('user_status','!=',DAL_Config::STATUS_DELETED)->first())
            return _ApiCode::USER_EMAIL_PHONE_EXIST;
        if($user = User::where('user_email', $email)
            ->where('user_status','!=',DAL_Config::STATUS_DELETED)->first())
            return _ApiCode::USER_EMAIL_EXIST;
        if($user = User::where('user_phone', $request->phone)
            ->where('user_status','!=',DAL_Config::STATUS_DELETED)->first())
            return _ApiCode::USER_PHONE_EXIST;
        if($newUser = $this->dal_user->createUser($data)) {
            dispatch(new ActivationEmail($newUser));
            return _ApiCode::SUCCESS;
        }
        return _ApiCode::ERROR_UNKNOWN;
    }

    public function redirectSocial($provider)
    {
        try {
            return Socialite::driver($provider)->redirect();
        } catch (\Exception $e) {
            return redirect()->route('frontend.home');
        }
    }

    public function callbackSocial($provider)
    {
        $usersocial = Socialite::driver($provider)->user();
        $account = Social_account::where('acc_provider', $provider)
            ->where('acc_providerId', $usersocial->id)->first();
       
        if ($account) {
            $user = $account->user;
            Auth::login($user, true);
            return _ApiCode::SUCCESS;
        } else {
            $usersocial->social = $provider;
            return $usersocial;
        }
        return _ApiCode::ERROR_UNKNOWN;
    }

    public function getActive($code){
        $user = User::where('user_verifyCode',$code)->first();
        if($user){
            if ($user->user_verify == 1) return _ApiCode::USER_ACTIVATED;
            else {
                $user->user_verify = 1;
                $user->user_status = DAL_Config::USER_STATUS_PUBLIC;
                $user->save();
                return _ApiCode::SUCCESS;
            }
        }
        return _ApiCode::VERIFYCODE_NOT_FOUND;
    }

    public static function postRegisterSocial($request)
    {
        try {
            $email = strtolower($request->email);
            if($user = User::where('user_email', $email)
                ->where('user_status','!=',DAL_Config::STATUS_DELETED)->first() && 
                $user = User::where('user_phone', $request->phone)
                ->where('user_status','!=',DAL_Config::STATUS_DELETED)->first())
                return _ApiCode::USER_EMAIL_PHONE_EXIST;
            if($user = User::where('user_email', $email)
                ->where('user_status','!=',DAL_Config::STATUS_DELETED)->first())
                return _ApiCode::USER_EMAIL_EXIST;
            if($user = User::where('user_phone', $request->phone)
                ->where('user_status','!=',DAL_Config::STATUS_DELETED)->first())
                return _ApiCode::USER_PHONE_EXIST;

            $account = new Social_account([
                'acc_providerId' => $request->id,
                'acc_provider' => $request->social,
                'acc_email' => $email,
                'acc_status' => 1
            ]);

            $user = User::create([
                'user_email' => $email,
                'user_showName' => $request->name,
                'password' => bcrypt($request->password),
                'user_phone' => $request->phone,
                'user_city' => 0,
                'user_type' => DAL_Config::TYPE_USER_REGISTER,
                'user_role' => DAL_Config::ROLE_USER_NORMAL,
                'user_status' => DAL_Config::USER_STATUS_PUBLIC,
                'user_verify' => 0,
                'user_alias' => Common::CreateSlug($request->name),
                'user_avatar' => $request->avatar,
                'user_verifyCode' => Common::getUserVerifyCode()
            ]);
            $account->user()->associate($user);
            $account->save();
            Auth::login($user, true);
            return _ApiCode::SUCCESS;
        } catch (\Exception $e) {
            return _ApiCode::ERROR_UNKNOWN;
        }
    }

    public function saveToken($token){
        if ($token && $token != '') {
            Device_token::create([
                'token_user' => Auth::user()->user_id,
                'token_device' => 'web',
                'token_value' => $token,
                'token_push' => '',
                'token_expire' => '',
                'token_lastLogin' => Carbon::now(),
            ]);
            return _ApiCode::SUCCESS;
        }
    }

    public function getListNotify(){
        $user = Auth::user();
        $filter = 0;
        if(isset($_GET['filter'])) $filter = $_GET['filter'];
        switch ($filter){
            case 1:
                $list_notify = DatabaseNotification::where('type',OrderChange::class)
                    ->where('notifiable_id', $user->user_id)
                    ->orderBy('created_at','desc')->get();
                $lstNotify = [];
                foreach ($list_notify as $notify) {
                    if ($notify->data['cate'] == 1) {
                        array_push($lstNotify, $notify);
                    }
                }
                break;
            default:
                $list_notify = DatabaseNotification::where('notifiable_id', $user->user_id)
                    ->orderBy('created_at','desc')->get();
                $lstNotify = [];
                foreach ($list_notify as $notify) {
                    if ($notify->data['cate'] == 1) {
                        array_push($lstNotify, $notify);
                    }
                }
                break;
        }
        $notifies = Auth::user()->unreadNotifications()->get();
        foreach ($notifies as $notify) {
            if ($notify->data['cate'] == 1) {
                $notify->update(['read_at' => Carbon::now()]);
            }
        }
        return [
            'lstNotify' => $lstNotify,
            'sidebar' => $filter
        ];
    }

    public function getProfile(){
        return [
            'user' => Auth::getUser(),
            'sidebar' => 10,
        ];
    }

    public function postChangeProfile($request){
        $user = Auth::getUser();
        if($user && $user->user_id) {
            $birthday = null;
            if ($request->birthday) {
                try {
                    $birthday = Carbon::make($request->birthday)->toDateString();
                } catch (\Exception $e) {
                    //log exception
                    activity()->performedOn(User::getModel())
                        ->causedBy(Auth::user())
                        ->withProperties(['action' => 'postChangeProfile'])
                        ->log("line ".$e->getLine()." file ".$e->getFile() ."\n".$e->getMessage());
                    \Log::error($e->getMessage(),$e->getTrace());
                }
            }
            $array = [
                'user_email' => strtolower($request->email),
                'user_phone' => $request->phone,
                'user_address' => $request->address,
                'user_showName' => $request->name,
                'user_city' => $request->city,
                'user_gender' => $request->gender,
                'user_birthday' => $birthday
            ];
            if ($this->dal_user->updateUser($user->user_id, $array)) {
                return _ApiCode::SUCCESS;
            }
        }
        return _ApiCode::ERROR_UNKNOWN;
    }

    public function getChangePass(){
        return [
            'user' => Auth::getUser(),
            'sidebar' => 11,
        ];
    }

}