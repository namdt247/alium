<?php
/**
 * Created by PhpStorm.
 * User: QuanVH
 * Date: 17/02/2017
 * Time: 21:54 CH
 */

namespace App\Http\Business\Admin;


use App\Helper\_ApiCode;
use App\Helper\_ObjectType;
use App\Helper\Common;
use App\Http\DAL\DAL_Config;
use App\Http\DAL\DAL_Supplier;
use App\Jobs\ActivationEmail;
use App\Jobs\OrderChangeSale;
use App\Models\Supplier;
use App\Models\Supplier_detail;
use App\Models\User;
use App\Models\User_detail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use TomLingham\Searchy\Facades\Searchy;

class BzUser extends BzAdmin
{
    protected $dal_supplier;

    public function __construct()
    {
        parent::__construct();
        $this->dal_supplier = new DAL_Supplier();
    }

    public function postLogin($request){
        $user = $this->dal_user->getDetailUser($request->username);
        if(isset($user) && $user->user_status != DAL_Config::STATUS_DELETED)
            return true;
        return false;
    }

    public function postChangePass($request){
        return $this->dal_user->updateUser(Auth::user()->user_id,[
            'password' => bcrypt($request->txtPassword)
        ]);
    }

    public function getDetailUser($userId){
        return $this->dal_user->getDetailUser($userId);
    }

    public function getDeleteUser($userId){
        $user = $this->dal_user->getDetailUserById($userId);
        if ($user && $user->user_id){
            $user->user_status = DAL_Config::STATUS_DELETED;
            $user->syncPermissions([]);
            $user->save();
            return _ApiCode::SUCCESS;
        }
        return _ApiCode::ERROR_UNKNOWN;
    }

    public function getListUserData(){
        $columns = array(
            0 =>'user_id',
            1 => 'user_name',
            2 => 'user_showName',
            3 => 'user_email',
            4 => 'user_phone',
            5 => 'user_id',
        );
        $order = $columns[$_GET['order'][0]['column']];
        $direct = $_GET['order'][0]['dir'];
        $number = $_GET['length'];
        $search = $_GET['search']['value'];
        $start = $_GET['start'];
        $page = round($start/$number)+1;

        Common::SetCurrentPage($page);
        if($search != ''){
            $lstUser = Searchy::search('user')->fields('user_name')->query($search)->get();
            return [
                'data' => $lstUser,
                'total' => 10
            ];

        }
        else{
            return $this->dal_user->getListUser([DAL_Config::USER_STATUS_PUBLIC],$order,$direct,$number);
        }
    }

    public function getListUserManageData(){
        $number = $_GET['length'];
        $search = $_GET['search']['value'];
        $start = $_GET['start'];
        $page = round($start/$number)+1;

        Common::SetCurrentPage($page);
        if($search != ''){
            $lstUser = Searchy::search('user')->fields('user_email','user_showName')->query($search)
                ->getQuery()
                ->whereIn('user_role',[DAL_Config::ROLE_USER_ADMIN,DAL_Config::ROLE_USER_MOD])
                ->where('user_status',DAL_Config::USER_STATUS_PUBLIC)->get();
            return [
                'data' => $lstUser,
                'total' => 10,
            ];

        }
        else{
            return $this->dal_user->getListUserManage($number);
        }
    }

    public function getListUserRegister(){
        $textSearch = isset($_GET['query']) ? $_GET['query'] : '';
        $startDate = Carbon::createFromDate(2019,6,1);
        $endDate = Carbon::now() ;
        if( isset($_GET['date']) ) {
            $txtDateRange = $_GET['date'];
            $lstDate = explode('-', $txtDateRange);
            $startDate = trim($lstDate[0]);
            $endDate = count($lstDate)>1 ? trim($lstDate[1]) : Carbon::now();
        }
        $cityId = isset($_GET['city']) ? $_GET['city'] : 0;
        if ($textSearch && $textSearch != ''){
            $query = Searchy::search('user')->fields('user_showName', 'user_email', 'user_phone')
                ->query($textSearch)
                ->getQuery()
                ->where('user_role',DAL_Config::ROLE_USER_NORMAL)
                ->whereIn('user_status',[DAL_Config::USER_STATUS_PUBLIC,DAL_Config::USER_STATUS_PENDING]);
            if($cityId != 0) $query = $query->where('user_city',$cityId);
            return User::hydrate($query->get()->toArray());
        }
        else{
            return $this->dal_user->getListUserRegister($startDate,$endDate,$cityId,3 * DAL_Config::NUM_PER_PAGE_USER);
        }

    }

    public function getListUserRegisterSale(){
        $textSearch = isset($_GET['query']) ? $_GET['query'] : '';
        $startDate = Carbon::createFromDate(2019,6,1);
        $endDate = Carbon::now() ;
        if( isset($_GET['date']) ) {
            $txtDateRange = $_GET['date'];
            $lstDate = explode('-', $txtDateRange);
            $startDate = trim($lstDate[0]);
            $endDate = count($lstDate)>1 ? trim($lstDate[1]) : Carbon::now();
        }
        $cityId = isset($_GET['city']) ? $_GET['city'] : 0;
        if ($textSearch && $textSearch != ''){
            $query = Searchy::search('user')->fields('user_showName', 'user_email', 'user_phone')
                ->query($textSearch)
                ->get()
                ->where('user_role',DAL_Config::ROLE_USER_NORMAL)
                ->whereIn('user_status',[DAL_Config::USER_STATUS_PUBLIC,DAL_Config::USER_STATUS_PENDING]);
            if($cityId != 0) {
                $query = $query->where('user_city',$cityId)->pluck('user_id');
                $list_user_id = User_detail::whereIn('dt_user', $query)
                    ->where('dt_name', 'sale')
                    ->where('dt_value', Auth::user()->user_id)
                    ->pluck('dt_user');
            } else {
                $query = $query->pluck('user_id');
                $list_user_id = User_detail::whereIn('dt_user', $query)
                    ->where('dt_name', 'sale')
                    ->where('dt_value', Auth::user()->user_id)
                    ->pluck('dt_user');
            }
            return User::whereIn('user_id', $list_user_id)->get();
        }
        else{
            return $this->dal_user->getListUserRegisterSale($startDate,$endDate,$cityId,3 * DAL_Config::NUM_PER_PAGE_USER);
        }

    }

    public function getEmailActiveRegister($userId){
        $user = $this->dal_user->getDetailUserById($userId);
        dispatch(new ActivationEmail($user));
        return _ApiCode::SUCCESS;
    }

    public function getLockUser($userId){
        $user = $this->dal_user->getDetailUserById($userId);
        if ($user && $user->user_id){
            $user->user_status = DAL_Config::USER_STATUS_LOCKED;
            $user->syncPermissions([]);
            $user->save();
            return _ApiCode::SUCCESS;
        }
        return _ApiCode::ERROR_UNKNOWN;
    }

    public function getUnLockUser($userId){
        if ($this->dal_user->updateUser($userId,[
            'user_status' => DAL_Config::USER_STATUS_PUBLIC
        ])) return _ApiCode::SUCCESS;
        return _ApiCode::ERROR_UNKNOWN;
    }

    public function getActiveUserRegister($userId) {
        if ($this->dal_user->updateUser($userId,[
            'user_status' => DAL_Config::USER_STATUS_PUBLIC,
        ])) return _ApiCode::SUCCESS;
        return _ApiCode::ERROR_UNKNOWN;
    }

    public function getDeleteUserRegister($userId){
        if ($this->dal_user->updateUser($userId,[
            'user_status' => DAL_Config::STATUS_DELETED
        ])) return _ApiCode::SUCCESS;
        return _ApiCode::ERROR_UNKNOWN;
    }

    public function postAddUserRegister($request){
        $birthday = null;
        $email = strtolower($request->txtEmail);
        $phone = $request->txtPhone;

        if ($email) {
            $emailUser = $this->dal_user->getDetailUser($email);
            if($emailUser && $emailUser->user_id) return _ApiCode::USER_EMAIL_EXIST;
        }
        if ($phone) {
            $phoneUser = $this->dal_user->getDetailUser($request->txtPhone);
            if($phoneUser && $phoneUser->user_id) return _ApiCode::USER_PHONE_EXIST;
        }
        if ($request->birthday) {
            try {
                $birthday = Carbon::make($request->birthday)->toDateString();
            } catch (\Exception $e) {
                //log exception
                activity()->performedOn(User::getModel())
                    ->causedBy(Auth::user())
                    ->withProperties(['action' => 'postAddUserRegister'])
                    ->log("line ".$e->getLine()." file ".$e->getFile() ."\n".$e->getMessage());
                \Log::error($e->getMessage(),$e->getTrace());
            }
        }
        $array = [
            'password' => bcrypt($request->txtPassword),
            'user_email' => $email,
            'user_phone' => $request->txtPhone,
            'user_type' => DAL_Config::TYPE_USER_REGADMIN,
            'user_role' => DAL_Config::ROLE_USER_NORMAL,
            'user_status' => DAL_Config::USER_STATUS_PUBLIC,
            'user_verify' => 1,
            'user_showName' => $request->txtShowName,
            'user_alias' => Common::CreateSlug($request->txtShowName),
            'user_city' => $request->sltCity,
            'user_gender' => $request->sltGender,
            'user_birthday' => $birthday,
            'user_verifyCode' => Common::getUserVerifyCode()
        ];
        //generate verify code
        if($this->dal_user->createUser($array)) return _ApiCode::SUCCESS;
        return _ApiCode::ERROR_UNKNOWN;
    }

    public function postAddUserSale($request){
        $birthday = null;
        $email = strtolower($request->txtEmail);
        $phone = $request->txtPhone;

        if ($email) {
            $emailUser = $this->dal_user->getDetailUser($email);
            if($emailUser && $emailUser->user_id) return _ApiCode::USER_EMAIL_EXIST;
        }
        if ($phone) {
            $phoneUser = $this->dal_user->getDetailUser($request->txtPhone);
            if($phoneUser && $phoneUser->user_id) return _ApiCode::USER_PHONE_EXIST;
        }
        if ($request->birthday) {
            try {
                $birthday = Carbon::make($request->birthday)->toDateString();
            } catch (\Exception $e) {
                //log exception
                activity()->performedOn(User::getModel())
                    ->causedBy(Auth::user())
                    ->withProperties(['action' => 'postAddUserRegister'])
                    ->log("line ".$e->getLine()." file ".$e->getFile() ."\n".$e->getMessage());
                \Log::error($e->getMessage(),$e->getTrace());
            }
        }
        $array = [
            'password' => bcrypt($request->txtPassword),
            'user_email' => $email,
            'user_phone' => $request->txtPhone,
            'user_type' => DAL_Config::TYPE_USER_REGADMIN,
            'user_role' => DAL_Config::ROLE_USER_NORMAL,
            'user_status' => DAL_Config::USER_STATUS_PUBLIC,
            'user_verify' => 1,
            'user_showName' => $request->txtShowName,
            'user_alias' => Common::CreateSlug($request->txtShowName),
            'user_city' => $request->sltCity,
            'user_gender' => $request->sltGender,
            'user_birthday' => $birthday,
            'user_verifyCode' => Common::getUserVerifyCode()
        ];
        //generate verify code
        $user = $this->dal_user->createUser($array);
        if ($user && $user->user_id) {
            User_detail::create([
                'dt_user' => $user->user_id,
                'dt_name' => _ObjectType::KEY_SALE,
                'dt_value' => Auth::user()->user_id
            ]);
            if ($request->sltSource) {
                User_detail::create([
                    'dt_user' => $user->user_id,
                    'dt_name' => _ObjectType::KEY_SOURCE,
                    'dt_value' => $request->sltSource
                ]);
            }
            if ($request->txtNote) {
                User_detail::create([
                    'dt_user' => $user->user_id,
                    'dt_name' => _ObjectType::KEY_NOTE,
                    'dt_value' => $request->txtNote
                ]);
            }
            return _ApiCode::SUCCESS;
        }
        return _ApiCode::ERROR_UNKNOWN;
    }

    public function postAddUserSupplier($request){
        \DB::beginTransaction();
        try {
            $supplier = Supplier::find($request->spId);
            if ($supplier && $supplier->sp_manager) return _ApiCode::SUPPLIER_USER_EXIST;

            $birthday = null;
            $email = strtolower($request->txtEmail);
            if ($request->birthday) {
                try {
                    $birthday = Carbon::make($request->birthday)->toDateString();
                } catch (\Exception $e) {
                    //log exception
                    activity()->performedOn(User::getModel())
                        ->causedBy(Auth::user())
                        ->withProperties(['action' => 'postAddUserRegister'])
                        ->log("line ".$e->getLine()." file ".$e->getFile() ."\n".$e->getMessage());
                    \Log::error($e->getMessage(),$e->getTrace());
                }
            }
            if ($email) {
                $emailUser = $this->dal_user->getDetailUser($email);
                if($emailUser && $emailUser->user_id) return _ApiCode::USER_EMAIL_EXIST;
                $phoneUser = $this->dal_user->getDetailUser($request->txtPhone);
                if($phoneUser && $phoneUser->user_id) return _ApiCode::USER_PHONE_EXIST;
            }
            $array = [
                'password' => bcrypt(12345678),
                'user_email' => $email,
                'user_phone' => $request->txtPhone,
                'user_type' => DAL_Config::TYPE_USER_REGADMIN,
                'user_role' => DAL_Config::ROLE_USER_NORMAL,
                'user_status' => DAL_Config::USER_STATUS_PUBLIC,
                'user_verify' => 1,
                'user_showName' => $request->txtShowName,
                'user_alias' => Common::CreateSlug($request->txtShowName),
                'user_birthday' => $birthday,
                'user_verifyCode' => Common::getUserVerifyCode()
            ];

            if ($supplier && $supplier->sp_id) {
                $generalInfo = $this->dal_supplier->getDefaultSupplierInfo(_ObjectType::KEY_GENERAL_INFO);
                $generalInfo['logo'] = $supplier->sp_avatar;
                $generalInfo['companyName'] = $supplier->sp_name;
                $generalInfo['email'] = $supplier->sp_email;
                $generalInfo['phone'] = $supplier->sp_phone;
                $generalInfo['address'] = $supplier->sp_location;
                $generalInfo['city'] = $supplier->sp_city;
                $generalInfo['numEmployee'] = $supplier->sp_numEmployee;
                $this->dal_supplier->setSupplierInfo($supplier->sp_id, _ObjectType::KEY_GENERAL_INFO, $generalInfo);

                $businessOwnerInfo = $this->dal_supplier->getDefaultSupplierInfo(_ObjectType::KEY_BUSINESS_OWNER);
                $businessOwnerInfo['phone'] = $supplier->sp_phone;
                $this->dal_supplier->setSupplierInfo($supplier->sp_id,
                    _ObjectType::KEY_BUSINESS_OWNER, $businessOwnerInfo);

                $businessOrderProcess = $this->dal_supplier->getDefaultSupplierInfo(_ObjectType::KEY_ORDER_PROCESS);
                foreach ($supplier->sp_detail as $detail) {
                    if ($detail->sp_name == 'phonePersonal') {
                        $detailValue = $detail->sp_detail;
                        if ($detailValue) {
                            $businessOrderProcess['phone'] = $detailValue['value'];
                        }
                    }
                    if ($detail->sp_name == 'emailPersonal') {
                        $detailValue = $detail->sp_detail;
                        if ($detailValue) {
                            $businessOrderProcess['email'] = $detailValue['value'];
                        }
                    }
                }
                $this->dal_supplier->setSupplierInfo($supplier->sp_id,
                    _ObjectType::KEY_ORDER_PROCESS, $businessOrderProcess);

                $this->dal_supplier->setSupplierInfo($supplier->sp_id,
                    _ObjectType::KEY_ADVANCE_INFO,
                    $this->dal_supplier->getDefaultSupplierInfo(_ObjectType::KEY_ADVANCE_INFO));
                $this->dal_supplier->setSupplierInfo($supplier->sp_id,
                    _ObjectType::KEY_SERVICE,
                    $this->dal_supplier->getDefaultSupplierInfo(_ObjectType::KEY_SERVICE));
                $supplier->save();

                $user = $this->dal_user->createUser($array);
                if($user && $user->user_id){
                    Supplier_detail::where('sp_supplier', $supplier->sp_id)
                        ->where('sp_name', 'bankAccount')->delete();
                    $supplier->sp_manager = $user->user_id;
                    $supplier->save();
                    \DB::commit();
                    return _ApiCode::SUCCESS;
                }
            }
            \DB::rollBack();
            return _ApiCode::ERROR_UNKNOWN;
        } catch (\Exception $e) {
            \DB::rollBack();
            return _ApiCode::ERROR_UNKNOWN;
        }
    }

    public function postAddUserManage($request) {
        $email = strtolower($request->txtEmail);
        $emailUser = $this->dal_user->getDetailUser($email);
        if($emailUser && $emailUser->user_id) return _ApiCode::USER_EMAIL_EXIST;
        $array = [
            'password' => bcrypt('123456'),
            'user_email' => $email,
            'user_type' => DAL_Config::TYPE_USER_SYSTEM,
            'user_role' => DAL_Config::ROLE_USER_MOD,
            'user_status' => DAL_Config::USER_STATUS_PUBLIC,
            'user_verify' => 1,
            'user_showName' => $request->txtShowName,
            'user_alias' => Common::CreateSlug($request->txtShowName),
            'user_verifyCode' => Common::getUserVerifyCode()
        ];

        if($user = $this->dal_user->createUser($array)) {
            $user->assignRole('moderator');
            $user->syncPermissions($request->sltPermission);
            return _ApiCode::SUCCESS;
        }
        return _ApiCode::ERROR_UNKNOWN;
    }

    public function postEditUserRegister($request) {
        $userId = $request->get('lbId');
        $email = strtolower($request->txtEmail);
        $user = $this->dal_user->getDetailUserById($userId);
        $tmpUser = $this->dal_user->getDetailUser($email);
        if(isset($tmpUser) && $tmpUser->user_id != $userId){
            return -1;
        }
        $array = [
            'user_name' => $request->txtName,
            'user_phone' => $request->txtPhone,
            'user_type' => DAL_Config::TYPE_USER_SYSTEM,
            'user_role' => $request->sltRole,
            'user_address' => $request->txtAddress1,
            'user_showName' => $request->txtShowName,
            'user_alias' => Common::CreateSlug($request->txtName)
        ];

        $userRole = $this->dal_user->getDetailRole($request->sltRole);

        $file = Input::file('imgFeature');
        if(isset($file)){
            $imgUpload = $this->CommonUpload(DAL_Config::IMAGE_ALIAS_USER,'imgFeature',$array['user_name']);
            if(isset($imgUpload) && $imgUpload != ''){
                $this->imageCrop->RemoveThumb($user->user_avatar);
                $this->imageCrop->MakeUserThumb($imgUpload);
                $array['user_avatar'] = $imgUpload;
            }
        }
        if($this->dal_user->updateUser($userId,$array)){
            $user->syncRoles([$userRole->role_name]);
            return 1;
        }
        return -1;
    }

    public function postAddUser($request){
        $array = [
            'user_name' => $request->txtName,
            'password' => bcrypt($request->txtPassword),
            'user_des' => $request->txtDes,
            'user_email' => strtolower($request->txtEmail),
            'user_phone' => $request->txtPhone,
            'user_address' => $request->txtAddress1,
            'user_type' => DAL_Config::TYPE_USER_SYSTEM,
            'user_role' => $request->sltRole,
            'user_showName' => $request->txtShowName,
            'user_alias' => Common::CreateSlug($request->txtName),
            'user_verifyCode' => Common::getUserVerifyCode()
        ];

        $imgUpload = $this->CommonUpload(DAL_Config::IMAGE_ALIAS_USER,Input::file('imgFeature'),$array['user_name']);
        if(isset($imgUpload) && $imgUpload != ''){
            $this->imageCrop->MakeUserThumb($imgUpload);
            $array['user_avatar'] = $imgUpload;
        }
        if($this->dal_user->createUser($array)) return true;
        return false;
    }

    public function getEditUser($userId){
        return $this->dal_user->getDetailUserById($userId);
    }

    public function postEditUser($request){
        $userId = $request->get('lbId');
        $user = $this->dal_user->getDetailUserById($userId);
        if($user && $user->user_id) {
            $birthday = null;
            $email = strtolower($request->txtEmail);
            $phone = $request->txtPhone;

            if ($email) {
                $emailUser = $this->dal_user->getDetailUser($email);
                if ($emailUser && ($user->user_id != $emailUser->user_id))
                    return _ApiCode::USER_EMAIL_EXIST;
            }
            if (!$phone)
                return _ApiCode::ERROR_UNKNOWN;
            else {
                $phoneUser = $this->dal_user->getDetailUser($phone);
                if ($phoneUser && ($user->user_id != $phoneUser->user_id))
                    return _ApiCode::USER_PHONE_EXIST;
            }

            if ($request->birthday) {
                try {
                    $birthday = Carbon::make($request->birthday)->toDateString();
                } catch (\Exception $e) {
                    //log exception
                    activity()->performedOn(User::getModel())
                        ->causedBy(Auth::user())
                        ->withProperties(['action' => 'postEditUser'])
                        ->log("line ".$e->getLine()." file ".$e->getFile() ."\n".$e->getMessage());
                    \Log::error($e->getMessage(),$e->getTrace());
                }

            }
            $array = [
                'user_email' => $email,
                'user_phone' => $phone,
                'user_address' => $request->txtAddress,
                'user_showName' => $request->txtShowName,
                'user_city' => $request->sltCity,
                'user_gender' => $request->sltGender,
                'user_birthday' => $birthday
            ];
            if ($this->dal_user->updateUser($userId, $array)) {
                $dataSource = false;
                $dataNote = false;
                foreach ($user->userDetail as $detail) {
                    if ($detail->dt_name == _ObjectType::KEY_SOURCE) {
                        $dataSource = true;
                    }
                    if ($detail->dt_name == _ObjectType::KEY_NOTE) {
                        $dataNote = true;
                    }
                }
                if ($dataSource) {
                    User_detail::where('dt_user', $user->user_id)
                        ->where('dt_name', _ObjectType::KEY_SOURCE)
                        ->update([
                            'dt_value' => $request->sltSource
                        ]);
                } elseif ($request->sltSource) {
                    User_detail::create([
                        'dt_user' => $user->user_id,
                        'dt_name' => _ObjectType::KEY_SOURCE,
                        'dt_value' => $request->sltSource
                    ]);
                }

                if ($dataNote) {
                    User_detail::where('dt_user', $user->user_id)
                        ->where('dt_name', _ObjectType::KEY_NOTE)
                        ->update([
                            'dt_value' => $request->txtNote
                        ]);
                } elseif ($request->txtNote) {
                    User_detail::create([
                        'dt_user' => $user->user_id,
                        'dt_name' => _ObjectType::KEY_NOTE,
                        'dt_value' => $request->txtNote
                    ]);
                }

                // set permission
                $user->syncPermissions($request->sltPermission);
                return _ApiCode::SUCCESS;
            }
        }
        return _ApiCode::ERROR_UNKNOWN;
    }

    public function postAssigneeSale($request) {
        $userId = $request->get('lbId');
        $user = $this->dal_user->getDetailUserById($userId);
        $saleId = $request->sale;
        $user_detail = User_detail::where('dt_user', $user->user_id)
            ->where('dt_name', _ObjectType::KEY_SALE)
            ->first();
        if ($user && $user->user_id && $saleId > 0) {
            $contentNotify = [
                'msTitle' => 'Khách hàng mới được giao cho bạn',
                'msMessage' => sprintf('Khách hàng %s đã được giao cho bạn', $user->user_showName),
                'msUrl' => route('admin.user.getEdit',$userId),
                'msSale' => '',
            ];

            if (!$user_detail) {
                User_detail::create([
                    'dt_user' => $userId,
                    'dt_name' => _ObjectType::KEY_SALE,
                    'dt_value' => $saleId
                ]);
            } else {
                User_detail::where('dt_user', $user->user_id)
                    ->where('dt_name', _ObjectType::KEY_SALE)
                    ->update([
                        'dt_value' => $saleId
                    ]);
            }
            dispatch(new OrderChangeSale($contentNotify, $saleId));
            return _ApiCode::SUCCESS;
        }
        return _ApiCode::ERROR_UNKNOWN;
    }

    public function getSearchUser(){
        $result = array();
        if(isset($_GET['q'])) {
            $search = trim(mb_strtolower($_GET['q']));
            $lstUser = Searchy::search('user')->fields('user_id','user_showName','user_phone','user_email')
                ->query($search)->getQuery()
                ->whereIn('user_status',[DAL_Config::USER_STATUS_PUBLIC])
                ->where('user_role',DAL_Config::ROLE_USER_NORMAL)->get();
        }
        else
            $lstUser = User::whereIn('user_status',[DAL_Config::USER_STATUS_PUBLIC])
            ->where('user_role',DAL_Config::ROLE_USER_NORMAL)->get();
        foreach ($lstUser as $user){
            array_push($result,['id'=>$user->user_id,'text'=>$user->user_id. ' - ' .$user->user_showName]);
        }
        return $result;
    }
}