<?php
/**
 * Created by PhpStorm.
 * User: QuanVH
 * Date: 17/02/2017
 * Time: 21:45 CH
 */

namespace App\Http\Controllers\Admin;


use App\Helper\_ApiCode;
use App\Http\Business\Admin\BzSupplier;
use App\Http\Business\Admin\BzUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddSupplierRequest;
use App\Http\Requests\UserAddRequest;
use App\Http\Requests\UserSupplierRequest;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    protected $bzSupplier;
    protected $bzUser;
    public function __construct()
    {
        $this->bzSupplier = new BzSupplier();
        $this->bzUser = new BzUser();
        parent::__construct();
    }


    public function getListSupplier() {
        return view('admin.user.list_supplier');
    }

    public function getListSupplierData() {
        return $this->bzSupplier->getListSupplierData();
    }

    public function getAddSupplier() {
        return view('admin.user.add_supplier');
    }

    public function postAddSupplier(AddSupplierRequest $request){
        $errorCode = $this->bzSupplier->postAddSupplier($request);
        if($errorCode == _ApiCode::SUCCESS){
            return redirect()->back()->with(['success_message' => 'Thêm mới nhà xưởng thành công']);
        }
        else{
            return redirect()->back()->with(['error_message' => 'Thêm mới nhà xưởng không thành công']);
        }
    }

    public function getActiveSupllier($spId) {
        $errorCode = $this->bzSupplier->getActiveSupplier($spId);
        if($errorCode == _ApiCode::SUCCESS){
            return redirect()->back()->with(['success_message' => 'Kích hoạt nhà xưởng thành công']);
        }
        else{
            return redirect()->back()->with(['error_message' => 'Kích hoạt nhà xưởng không thành công']);
        }
    }

    public function getCheckSupplier($phone){
        if($this->bzSupplier->getCheckSupplier($phone)) return _ApiCode::SUCCESS;
        else return _ApiCode::ERROR_UNKNOWN;
    }

    public function getEditSupplier($spId){
        $supply = $this->bzSupplier->getEditSupplier($spId);
        return view('admin.user.edit_supplier',compact('supply'));
    }

    public function postEditSupplier(Request $request){
        $errorCode = $this->bzSupplier->postEditSupplier($request);
        if($errorCode == _ApiCode::SUCCESS){
            return redirect()->back()->with(['success_message' => 'Chỉnh sửa thông tin nhà xưởng thành công']);
        } else{
            return redirect()->back()->with(['error_message' => 'Chỉnh sửa thông tin nhà xưởng không thành công']);
        }
    }

    public function getDeleteImageSupplier($id,$imgId){
        $errorCode = $this->bzSupplier->getDeleteImageSupplier($id,$imgId);
        if($errorCode == _ApiCode::SUCCESS){
            return redirect()->back()->with(['success_message' => 'Xóa ảnh sản phẩm thành công']);
        } else{
            return redirect()->back()->with(['error_message' => 'Xóa ảnh sản phẩm không thành công']);
        }
    }

    public function getDeleteSupplier($spId) {
        $errorCode = $this->bzSupplier->getDeleteSupplier($spId);
        if($errorCode == _ApiCode::SUCCESS){
            return redirect()->back()->with(['success_message' => 'Xóa nhà xưởng thành công']);
        }
        else{
            return redirect()->back()->with(['error_message' => 'Xóa nhà xưởng không thành công']);
        }
    }

    public function getSearchSupplier(){
        return $this->bzSupplier->getSearchSupplier();
    }

    public function getAddUserSupplier($spId){
        $supplier = $this->bzSupplier->getEditSupplier($spId);
        if ($supplier && $supplier->sp_manager) {
            return redirect(route('admin.supplier.getList'));
        }
        return view('admin.user.add_user_supplier',compact('supplier'));
    }

    public function postAddUserSupplier(UserSupplierRequest $request){
        $errorCode = $this->bzUser->postAddUserSupplier($request);
        switch ($errorCode) {
            case _ApiCode::SUCCESS:
                return redirect(route('admin.supplier.getList'))->with(['success_message' => 'Thêm mới người dùng thành công']);
                break;
            case _ApiCode::USER_EMAIL_EXIST:
                return redirect()->back()->with(['error_message' => 'Địa chỉ email đã được đăng ký']);
                break;
            case _ApiCode::USER_PHONE_EXIST:
                return redirect()->back()->with(['error_message' => 'SDT đã được đăng ký']);
                break;
            case _ApiCode::SUPPLIER_USER_EXIST:
                return redirect(route('admin.supplier.getList'))->with(['error_message' => 'Tài khoản xưởng đã tồn tại']);
                break;
            default:
                return redirect()->back()->with(['error_message' => 'Thêm mới người dùng không thành công']);
        }
    }
}