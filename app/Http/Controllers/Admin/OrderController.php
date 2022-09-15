<?php
/**
 * Created by PhpStorm.
 * User: QuanVH
 * Date: 17/02/2017
 * Time: 21:45 CH
 */

namespace App\Http\Controllers\Admin;


use App\Helper\_ApiCode;
use App\Http\Business\Admin\BzOrder;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewOrderRequest;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Supply;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $bzOrder;
    public function __construct()
    {
        $this->bzOrder = new BzOrder();
        parent::__construct();
    }

    public function getListOrder(){
        return view('admin.product.list_order');
    }

    public function getListOrderData(){
        return $this->bzOrder->getListOrderData();
    }

    public function getAddOrder(){
        return view('admin.product.add_order');
    }

    public function postAddOrder(NewOrderRequest $request){
        $errorCode = $this->bzOrder->postAddOrder($request);
        if($errorCode == _ApiCode::SUCCESS)
            return redirect()->back()->with(['success_message' => 'Thêm mới đơn hàng thành công']);
        else
            return redirect()->back()->with(['error_message' => 'Thêm mới đơn hàng không thành công']);
    }

    public function getChangeStatus($odId){
        $order = $this->bzOrder->getDetailOrder($odId);
        $price = $this->bzOrder->returnPriceAssignee($order);
        return view('admin.product.change_status_order',compact('order','price'));
    }

    public function postChangeStatus(Request $request){
        $errorCode = $this->bzOrder->postChangeStatus($request);
        if($errorCode == _ApiCode::SUCCESS)
            return redirect()->back()->with(['success_message' => 'Cập nhật đơn hàng thành công']);
        else
            return redirect()->back()->with(['error_message' => 'Cập nhật đơn hàng không thành công']);
    }

    public function getAssigneeOrder($odId){
        $order = $this->bzOrder->getDetailOrder($odId);
        return view('admin.product.assignee_order',compact('order'));
    }

    public function postAssigneeOrder(Request $request){
        $errorCode = $this->bzOrder->postAssigneeOrder($request);
        if($errorCode == _ApiCode::SUCCESS)
            return redirect()->back()->with(['success_message' => 'Cập nhật đơn hàng thành công']);
        else
            return redirect()->back()->with(['error_message' => 'Cập nhật đơn hàng không thành công']);
    }

    public function getAssigneeSupplierEmployeeOrder($odId){
        $order = $this->bzOrder->getDetailOrder($odId);
        return view('admin.product.assignee_supplier_employee',compact('order'));
    }

    public function postAssigneeSupplierEmployeeOrder(Request $request){
        $errorCode = $this->bzOrder->postAssigneeSupplierEmployeeOrder($request);
        if($errorCode == _ApiCode::SUCCESS)
            return redirect()->back()->with(['success_message' => 'Cập nhật đơn hàng thành công']);
        else
            return redirect()->back()->with(['error_message' => 'Cập nhật đơn hàng không thành công']);
    }

    public function getAssigneeSupplierOrder($odId){
        $order = $this->bzOrder->getDetailOrder($odId);
        $lst_product = Product::where('prd_status', 1)->get();
        $supllier = Supplier::where('sp_manager', $order->od_createdBy)->first();
        $lst_supplier = array();
        if ($supllier && $supllier->sp_id) {
            foreach ($lst_product as $prd) {
                $lst_supplier[$prd->prd_name] = Supply::where('sp_product', $prd->prd_id)
                    ->where('sp_supply', '!=', $supllier->sp_id)
                    ->pluck('sp_supply')->toArray();
            }
        } else {
            foreach ($lst_product as $prd) {
                $lst_supplier[$prd->prd_name] = Supply::where('sp_product', $prd->prd_id)
                    ->pluck('sp_supply')->toArray();
            }
        }
        return view('admin.product.assignee_supplier',compact('order', 'lst_supplier'));
    }

    public function postAssigneeSupplierOrder(Request $request){
        $errorCode = $this->bzOrder->postAssigneeSupplierOrder($request);
        if($errorCode == _ApiCode::SUCCESS)
            return redirect()->back()->with(['success_message' => 'Cập nhật đơn hàng thành công']);
        else
            return redirect()->back()->with(['error_message' => 'Cập nhật đơn hàng không thành công']);
    }

    public function postUpdateNote(Request $request){
        return $this->bzOrder->postUpdateNote($request);
    }

    public function getListOrderSupplier(){
        $lstOrder = $this->bzOrder->getListOrderSupplier();
        return view('admin.supplier.list_order',compact('lstOrder'));
    }

    public function getChangeOrderSupplierEmployee($odId){
        $order = $this->bzOrder->getChangeOrderSupplier($odId);
        return view('admin.supplier.change_order',compact('order'));
    }

    public function getChangeOrderSupplier($odId){
        $order = $this->bzOrder->getChangeOrderSupplier($odId);
        return view('admin.supplier.change_status_order',compact('order'));
    }

    public function postChangeOrderSupplier(Request $request){
        $errorCode = $this->bzOrder->postChangeOrderSupplier($request);
        if($errorCode == _ApiCode::SUCCESS)
            return redirect()->back()->with(['success_message' => 'Cập nhật đơn hàng thành công']);
        else
            return redirect()->back()->with(['error_message' => 'Cập nhật đơn hàng không thành công']);
    }

    public function getListOrderSale(){
        $lstOrder = $this->bzOrder->getListOrderSale();
        return view('admin.sale.list_order',compact('lstOrder'));
    }

    public function getChangeOrderSale($odId){
        $order = $this->bzOrder->getChangeOrderSale($odId);
        return view('admin.sale.change_status_order',compact('order'));
    }

    public function postChangeOrderSale(Request $request){
        $errorCode = $this->bzOrder->postChangeOrderSale($request);
        if($errorCode == _ApiCode::SUCCESS)
            return redirect()->back()->with(['success_message' => 'Cập nhật đơn hàng thành công']);
        else
            return redirect()->back()->with(['error_message' => 'Cập nhật đơn hàng không thành công']);
    }

    public function getDeleteOrder($odId){
        $errorCode = $this->bzOrder->getDeleteOrder($odId);
        if($errorCode == _ApiCode::SUCCESS)
            return redirect()->back()->with(['success_message' => 'Xóa đơn hàng thành công']);
        else
            return redirect()->back()->with(['error_message' => 'Xóa đơn hàng không thành công']);
    }

    public function getCancelOrder($odId){
        $errorCode = $this->bzOrder->getCancelOrder($odId);
        if($errorCode == _ApiCode::SUCCESS)
            return redirect()->back()->with(['success_message' => 'Hủy đơn hàng thành công']);
        else
            return redirect()->back()->with(['error_message' => 'Hủy đơn hàng không thành công']);
    }

    public function postCancelOrder(Request $request){
        $errorCode = $this->bzOrder->postCancelOrder($request);
        if($errorCode == _ApiCode::SUCCESS)
            return redirect()->back()->with(['success_message' => 'Hủy đơn hàng thành công']);
        else
            return redirect()->back()->with(['error_message' => 'Hủy đơn hàng không thành công']);
    }

    public function getEditOrder($odId) {
        $order = $this->bzOrder->getDetailOrder($odId);
        return view('admin.product.edit_order', compact('order'));
    }

    public function postEditOrder(NewOrderRequest $request) {
        $errorCode = $this->bzOrder->postEditOrder($request);
        if($errorCode == _ApiCode::SUCCESS)
            return redirect()->back()->with(['success_message' => 'Chỉnh sửa đơn hàng thành công']);
        else
            return redirect()->back()->with(['error_message' => 'Chỉnh sửa đơn hàng không thành công']);
    }

    public function getSearchOrder(){
        return $this->bzOrder->getSearchOrder();
    }

    public function uploadImageOrder(Request $request){
        return $this->bzOrder->uploadImageOrder($request);
    }

    public function getDeleteImageOrder($imgId) {
        return $this->bzOrder->getDeleteImageOrder($imgId);
    }


}