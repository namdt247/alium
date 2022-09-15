<?php
/**
 * Created by PhpStorm.
 * User: QuanVH
 * Date: 17/02/2017
 * Time: 21:45 CH
 */

namespace App\Http\Controllers\Frontend;


use App\Helper\_ApiCode;
use App\Helper\Common;
use App\Http\Business\Frontend\BzUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserRegisterSocialRequest;
use App\Http\Requests\UserResetPassRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use App\Models\User;


class UserController extends Controller
{
    protected $bzUser;
    public function __construct()
    {
        $this->bzUser = new BzUser();
        parent::__construct();
    }

    public function getLogin(){
        if(Auth::check()){
            return redirect()->route('frontend.home');
        }
        else
            return view('frontend.login');
    }

    public function postLogin(UserLoginRequest $request){
        return response()->json(Common::buildApiResponse([],$this->bzUser->postLogin($request)));
    }

    public function getActive($code){
        $errorCode = $this->bzUser->getActive($code);
        return view('frontend.user_activate',compact('errorCode'));
    }

    public function getLogout(){
        Auth::logout();
        return redirect()->route('frontend.home');
    }

    public function postRegister(UserRegisterRequest $request){
        return response()->json(Common::buildApiResponse([],$this->bzUser->postRegister($request)));
    }

    public function redirectSocial($provider){
        session(['keep_url' => url()->previous()]);
        return $this->bzUser->redirectSocial($provider);
    }

    public function callbackSocial($provider){
        $data = $this->bzUser->callbackSocial($provider);
        if($data === _ApiCode::SUCCESS) {
            return redirect()->route('frontend.home');
        }
        elseif($data->email) {
            $user_exist = User::where('user_email', $data->email)->first();
            if($user_exist) {
                if ($user_exist->user_status == 1 || $user_exist->user_status == 2) {
                    return view('frontend.social_user_exist',compact('user_exist'));
                } elseif ($user_exist->user_status == 3) {  
                    return view('frontend.user_lock');
                } else {
                    return false;
                }
            }else {
                return view('frontend.register',compact('data'));
            }
        }
        else {
            return view('frontend.register',compact('data'));
        }
        return false;
    }

    public function postRegisterSocial(UserRegisterSocialRequest $request){
        return response()->json(Common::buildApiResponse([],$this->bzUser->postRegisterSocial($request)));
    }

    public function getCodeForgetPass($email){
        return response()->json(Common::buildApiResponse([],$this->bzUser->getCodeForgetPass($email)));
    }

    public function postForgetPass(UserResetPassRequest $request){
        return response()->json(Common::buildApiResponse([],$this->bzUser->postForgetPass($request)));
    }

    public function getListNotify(){
        $data = $this->bzUser->getListNotify();
        return view('frontend.user_notify',compact('data'));
    }

    public function getProfile(){
        $data = $this->bzUser->getProfile();
        return view('frontend.user_profile',compact('data'));
    }

    public function postChangeProfile(Request $request){
        $errorCode = $this->bzUser->postChangeProfile($request);
        if($errorCode == _ApiCode::SUCCESS)
            return redirect()->back()->with(['success_message' => Lang::get('message.myAccount.notice1')]);
        else
            return redirect()->back()->with([
                'error_message' => Lang::get('message.myAccount.notice2')]);
    }

    public function getChangePass(){
        $data = $this->bzUser->getChangePass();
        return view('frontend.user_change_pass',compact('data'));
    }

    public function postChangePass(ChangePasswordRequest $request){
        $errorCode = $this->bzUser->postChangePass($request);
        switch($errorCode){
            case _ApiCode::SUCCESS:
                return redirect()->back()->with(['success_message' => Lang::get('message.myAccount.changePw.notice3')]);
                break;
            case _ApiCode::WRONG_PASS:
                return redirect()->back()->with(['error_message' => Lang::get('message.myAccount.changePw.notice1')]);
                break;
            default:
                return redirect()->back()->with(['error_message' => Lang::get('message.myAccount.changePw.notice4')]);
                break;
        }
    }

}