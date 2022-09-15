<?php
/**
 * Created by PhpStorm.
 * User: QuanVH
 * Date: 17/02/2017
 * Time: 21:45 CH
 */

namespace App\Http\Controllers\Admin;


use App\Helper\_ApiCode;
use App\Http\Business\Admin\BzUser;
use App\Http\Controllers\Controller;
use App\Http\DAL\DAL_Config;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UserAddRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            return redirect()->route('admin.dashboard');
        }
        else
            return view('admin.login');
    }

    public function postLogin(UserLoginRequest $request){
        $login = [
            'user_name' => $request->username,
            'password' => $request->password,
            'user_status'=>DAL_Config::USER_STATUS_PUBLIC
        ];
        $login2 = [
            'user_email' => $request->username,
            'password' => $request->password,
            'user_status'=>DAL_Config::USER_STATUS_PUBLIC
        ];

        if((Auth::attempt($login) || Auth::attempt($login2)) && $this->bzUser->postLogin($request)){
            return redirect()->intended('/admin');
        }
        else{
            Auth::logout();
            return redirect()->back()->with(['error_message' => 'Tên đăng nhập/mật khẩu không đúng']);
        }
    }

    public function getLogout(){
        Auth::logout();
        return redirect()->route('admin.login');
    }

    public function getChangePass(){
        return view('admin.user.change_password');
    }

    public function postChangePass(ChangePasswordRequest $request){
        if($this->bzUser->postChangePass($request))
            return redirect()->back()->with(['success_message' => 'Đổi mật khẩu thành công']);
        else
            return redirect()->back()->with(['error_message' => 'Đổi mật khẩu không thành công']);
    }

    public function getDeleteUser($userId){
        if($this->bzUser->getDeleteUser($userId))
            return redirect()->back()->with(['success_message' => 'Xóa người dùng thành công']);
        else
            return redirect()->back()->with(['error_message' => 'Xóa người dùng không thành công']);
    }

    public function getListUser(){
        return view('admin.user.list_user');
    }

    public function getListUserRegister() {
        $lstUser = $this->bzUser->getListUserRegister();
        return view('admin.user.list_user_register', compact('lstUser'));
    }

    public function getListUserRegisterSale() {
        $lstUser = $this->bzUser->getListUserRegisterSale();
        return view('admin.user.list_user_register_sale', compact('lstUser'));
    }

    public function getListUserRegisterSaleManager() {
        $lstUser = $this->bzUser->getListUserRegister();
        return view('admin.user.list_user_register_sale_manager', compact('lstUser'));
    }

    public function getAssigneeSale($userId) {
        $user = $this->bzUser->getEditUser($userId);
        return view('admin.user.assignee_sale',compact('user'));
    }

    public function postAssigneeSale(Request $request) {
        $errorCode = $this->bzUser->postAssigneeSale($request);
        if($errorCode == _ApiCode::SUCCESS)
            return redirect()->back()->with(['success_message' => 'Gán tài khoản thành công']);
        else
            return redirect()->back()->with(['error_message' => 'Gán tài khoản không thành công']);
    }

    public function getListUserManage(){
        return view('admin.user.list_user_manage');
    }

    public function getLockUser($userId){
        $errorCode = $this->bzUser->getLockUser($userId);
        if($errorCode == _ApiCode::SUCCESS)
            return redirect()->back()->with(['success_message' => 'Khóa tài khoản thành công']);
        else
            return redirect()->back()->with(['error_message' => 'Khóa tài khoản không thành công']);
    }

    public function getUnLockUser($userId){
        $errorCode = $this->bzUser->getUnLockUser($userId);
        if($errorCode == _ApiCode::SUCCESS)
            return redirect()->back()->with(['success_message' => 'Mở khóa tài khoản thành công']);
        else
            return redirect()->back()->with(['error_message' => 'Mở khóa tài khoản không thành công']);
    }

    public function getActiveUserRegister($userId){
        $errorCode = $this->bzUser->getActiveUserRegister($userId);
        if($errorCode == _ApiCode::SUCCESS)
            return redirect()->back()->with(['success_message' => 'Kích hoạt tài khoản người dùng thành công']);
        else
            return redirect()->back()->with(['error_message' => 'Kích hoạt tài khoản người dùng không thành công']);
    }

    public function getEmailActiveRegister($userId){
        $errorCode = $this->bzUser->getEmailActiveRegister($userId);
        if($errorCode == _ApiCode::SUCCESS)
            return redirect()->back()->with(['success_message' => 'Gửi email kích hoạt tài khoản thành công']);
        else
            return redirect()->back()->with(['error_message' => 'Gửi email kích hoạt tài khoản không thành công']);
    }

    public function getDeleteUserRegister($userId){
        $errorCode = $this->bzUser->getDeleteUserRegister($userId);
        if($errorCode == _ApiCode::SUCCESS)
            return redirect()->back()->with(['success_message' => 'Xóa người dùng thành công']);
        else
            return redirect()->back()->with(['error_message' => 'Xóa người dùng không thành công']);

    }

    public function getListUserData(){
        return $this->bzUser->getListUserData();
    }

    public function getListUserManageData(){
        return $this->bzUser->getListUserManageData();
    }

    public function getAddUserRegister(){
        return view('admin.user.add_user_register');
    }

    public function getAddUserManage(){
        return view('admin.user.add_user_manage');
    }

    public function getAddUserSale(){
        return view('admin.user.add_user_sale');
    }

    public function postAddUserRegister(UserAddRequest $request){
        $errorCode = $this->bzUser->postAddUserRegister($request);
        switch ($errorCode) {
            case _ApiCode::SUCCESS:
                return redirect()->back()->with(['success_message' => 'Thêm mới người dùng thành công']);
                break;
            case _ApiCode::USER_EMAIL_EXIST:
                return redirect()->back()->with(['error_message' => 'Địa chỉ email đã được đăng ký']);
                break;
            case _ApiCode::USER_PHONE_EXIST:
                return redirect()->back()->with(['error_message' => 'SDT đã được đăng ký']);
                break;
            default:
                return redirect()->back()->with(['error_message' => 'Thêm mới người dùng không thành công']);
        }
    }

    public function postAddUserSale(UserAddRequest $request){
        $errorCode = $this->bzUser->postAddUserSale($request);
        switch ($errorCode) {
            case _ApiCode::SUCCESS:
                return redirect()->back()->with(['success_message' => 'Thêm mới người dùng thành công']);
                break;
            case _ApiCode::USER_EMAIL_EXIST:
                return redirect()->back()->with(['error_message' => 'Địa chỉ email đã được đăng ký']);
                break;
            case _ApiCode::USER_PHONE_EXIST:
                return redirect()->back()->with(['error_message' => 'SDT đã được đăng ký']);
                break;
            default:
                return redirect()->back()->with(['error_message' => 'Thêm mới người dùng không thành công']);
        }
    }

    public function postAddUserManage(Request $request){
        $errorCode = $this->bzUser->postAddUserManage($request);
        if($errorCode == _ApiCode::USER_EMAIL_EXIST)
            return redirect()->back()->with(['error_message' => 'Địa chỉ email đã được đăng ký']);
        elseif($errorCode == _ApiCode::SUCCESS)
            return redirect()->back()->with(['success_message' => 'Thêm mới người dùng thành công']);
        else
            return redirect()->back()->with(['error_message' => 'Thêm mới người dùng không thành công']);
    }

    public function getEditUserRegister($userId){
        $user = $this->bzUser->getEditUser($userId);
        return view('admin.user.edit_user_register',compact('user'));
    }

    public function postEditUserRegister(Request $request){
        $errorCode = $this->bzUser->postEditUserRegister($request);
        if($errorCode == _ApiCode::SUCCESS)
            return redirect()->back()->with(['success_message' => 'Sửa thông tin người dùng thành công']);
        else
            return redirect()->back()->with(['error_message' => 'Sửa thông tin người dùng không thành công']);
    }

    public function postAddUser(Request $request){
//        $this->bzUser->postAddUser($request);
        if($this->bzUser->postAddUser($request))
            return redirect()->back()->with(['success_message' => 'Thêm mới người dùng thành công']);
        else
            return redirect()->back()->with(['error_message' => 'Thêm mới người dùng không thành công']);
    }

    public function getEditUser($userId){
        $user = $this->bzUser->getEditUser($userId);
        return view('admin.user.edit_user',compact('user'));
    }

    public function postEditUser(Request $request){
        $errorCode = $this->bzUser->postEditUser($request);
        switch ($errorCode) {
            case _ApiCode::SUCCESS:
                return redirect()->back()->with(['success_message' => 'Sửa thông tin người dùng thành công']);
                break;
            case _ApiCode::USER_EMAIL_EXIST:
                return redirect()->back()->with(['error_message' => 'Địa chỉ email đã được đăng ký']);
                break;
            case _ApiCode::USER_PHONE_EXIST:
                return redirect()->back()->with(['error_message' => 'SDT đã được đăng ký']);
                break;
            default:
                return redirect()->back()->with(['error_message' => 'Sửa thông tin người dùng không thành công']);
        }
    }

    public function getSearchUser(){
        return $this->bzUser->getSearchUser();
    }

    public function getDetailUser($userid){
        return $this->bzUser->getEditUser($userid);
    }
}