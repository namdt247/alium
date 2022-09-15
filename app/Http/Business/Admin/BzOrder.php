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
use App\Jobs\OrderChangeAlium;
use App\Jobs\OrderChangeFactory;
use App\Jobs\OrderChangeSale;
use App\Jobs\OrderChangeSupplier;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Order_status;
use App\Models\Order_supplier;
use App\Models\Supplier;
use App\Models\User;
use App\Notifications\OrderChange;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Notification;
use TomLingham\Searchy\Facades\Searchy;

class BzOrder extends BzAdmin
{
    public function getListOrderData(){
        $number = $_GET['length'];
        $start = $_GET['start'];
        $search = $_GET['search']['value'];
        $page = round($start/$number)+1;
        $statusId = $_GET['status'];
        $cityId = $_GET['city'];
        $productId = $_GET['product'];
        $employee = $_GET['employee'];
        Common::SetCurrentPage($page);
        if($search != ''){
            $query = Searchy::search('order')->fields('od_name', 'od_email','od_phone','od_code')
                ->query($search)->getQuery()->whereNotIn('od_status',[DAL_Config::STATUS_DELETED, 101]);
            if ($statusId && $statusId > 0){
                $lstStatus = Order_status::where('stt_parent',$statusId)->pluck('stt_id');
                $query = $query->whereIn('od_status',$lstStatus);
            } 
            if ($cityId && $cityId > 0) $query = $query->where('od_city',$cityId);
            if ($productId && $productId > 0) $query = $query->where('od_product',$productId);
            if ($employee && $employee >0 )
                $query= $query->where('od_sale',$employee)->orWhere('od_supplier',$employee);
            $query = $query->orderBy('created_at','desc');
            $lstOrder = Order::hydrate($query->limit(30)->get()->toArray());
            return [
                'data' => $lstOrder,
                'total' => 10,
            ];
        }
        else {
            $query = Order::whereNotIn('od_status',[DAL_Config::STATUS_DELETED, 101]);
            if ($statusId && $statusId > 0){
                $lstStatus = Order_status::where('stt_parent',$statusId)->pluck('stt_id');
                $query = $query->whereIn('od_status',$lstStatus);
            }
            if ($cityId && $cityId > 0) $query = $query->where('od_city',$cityId);
            if ($productId && $productId > 0) $query = $query->where('od_product',$productId);
            if ($employee && $employee >0 )
                $query= $query->where('od_sale',$employee)->orWhere('od_supplier',$employee);
            $query = $query->orderBy('created_at','desc');
            return $query->paginate($number);
        }
    }

    public function postAddOrder($request){
        $orderData = $this->dataOrderDetail($request);
        if(Auth::user()->can('sale'))
            $orderData['od_sale'] = Auth::user()->user_id;
        $orderData['od_status'] = 1;

        //create order
        if ($newOrder = $this->dal_order->createOrder($orderData)){
            //upload image
            $this->uploadOrderImage($newOrder);

            $newOrder->od_code = $this->genOrderCode($newOrder->od_id);
            Order::ChangeStatus($newOrder,9);

            $newOrder->save();
            return _ApiCode::SUCCESS;
        }
        return _ApiCode::ERROR_UNKNOWN;
    }

    public function getDeleteOrder($odId){
        try {
            $order = $this->dal_order->getDetailOrder($odId);
            $order->od_status = DAL_Config::STATUS_DELETED;
            $order->save();
            return _ApiCode::SUCCESS;
        } catch (\Exception $e) {
            return _ApiCode::ERROR_UNKNOWN;
        }
    }

    public function getDetailOrder($odId){
        return $this->dal_order->getDetailOrder($odId);
    }

    public function returnPriceAssignee($order){
        $lstQuality = \App\Http\DAL\DAL_Config::getConfigByLocale(7);
        $lastQuality = end($lstQuality);
        $retVal = [];
        foreach ($order->suggest_uMake as $suggest) {
            $detailValue = unserialize($suggest->od_detail);
            $priceUnit = $suggest->od_priceUnit;
            if ($priceUnit < 1000) {
                if ($order->od_quality == $lastQuality['id'])
                    $priceUnit = round($priceUnit / (1/1.25), -2);
                elseif ($order->od_quantity < 100) $priceUnit = round($priceUnit / (1/1.3), -2);
                else $priceUnit = round($priceUnit / (1/1.25), -2);
            } else {
                if ($order->od_quality == $lastQuality['id'])
                    $priceUnit = round($priceUnit / (1/1.25), -3);
                elseif ($order->od_quantity < 100) $priceUnit = round($priceUnit / (1/1.3), -3);
                else $priceUnit = round($priceUnit / (1/1.25), -3);
            }

            $totalPrice = $priceUnit * $order->od_quantity;
            if ($order->orderType['bill']) $totalPrice *= 1.1;
            if ($order->orderType['template']) {
                $payment1 = $detailValue['price_template'];
                if ($totalPrice < 100 * 1000 * 1000) {
                    $payment2 = $totalPrice;
                    $payment3 = 0;
                }
                else if ($totalPrice < 500 * 1000 * 1000) {
                    $payment2 = $totalPrice * 0.6;
                    $payment3 = $totalPrice * 0.4;
                }
                else {
                    $payment2 = $totalPrice * 0.4;
                    $payment3 = $totalPrice * 0.6;
                }
                $totalPrice += $detailValue['price_template'];
            }else {
                if ($totalPrice < 100 * 1000 * 1000) {
                    $payment1 = $totalPrice;
                    $payment2 = 0;
                } else if ($totalPrice < 500 * 1000 * 1000) {
                    $payment1 = $totalPrice * 0.6;
                    $payment2 = $totalPrice * 0.4;
                } else {
                    $payment1 = $totalPrice * 0.4;
                    $payment2 = $totalPrice * 0.6;
                }
                $payment3 = 0;
            }

            $additionData = [
                'price_unit' => $priceUnit,
                'total_price' => $totalPrice,
                'payment1' => $payment1,
                'payment2' => $payment2,
                'payment3' => $payment3,
            ];
            array_push($retVal,$additionData);
        }
        return $retVal;
    }

    public function getCancelOrder($odId){
        try {
            $order = $this->dal_order->getDetailOrder($odId);
            if ($order->od_status == 34){
                return _ApiCode::SUCCESS;
            }
            else {

                $message = 'Đơn hàng của bạn đã bị Alium huỷ ở giai đoạn ' . $order->status->stt_valueF .
                    '.Vui lòng vào mục Quản lý đơn hàng để kiểm tra đơn hàng.';

//            $url = route('frontend.order.getDetail',$order->od_code);
                $url = '/orders/' . $order->od_code;
                $title = 'Đơn hàng đã hủy';
                $name = $order->od_code . ' (' . $order->product->prd_name . ' - ' . $order->od_quantity . ' chiếc)';
                $action = 'Xem chi tiết';
                $image = '/img/order-template.png';
                if (count($order->image) > 0) {
                    $image = Common::GetThumb($order->image[0]->img_src);
                }
                $type = $order->od_status;
                $userOrder = User::find($order->od_createdBy);
                $contentNotify = [
                    'code'=>$order->od_code,
                    'cate' => 1,
                    'user' => $order->od_createdBy,
                    'url' => $url,
                    'type' => $type,
                    'title' => $title,
                    'message' => $message,
                    'name' => $name,
                    'action' => $action,
                    'image' => $image
                ];
                Order::ChangeStatus($order, 34);
                $this->dal_order->cancelOrder($order->od_id);
                Notification::send($userOrder, new OrderChange($contentNotify));
                $this->sendFCMMessage($contentNotify);

                $order->save();
                return _ApiCode::SUCCESS;
            }
        } catch (\Exception $e) {
            return _ApiCode::ERROR_UNKNOWN;
        }
    }

    public function postCancelOrder($request) {
        try {
            $order = $this->dal_order->getDetailOrder($request->odId);
            if ($order && $order->od_id) {
                if ($order->od_status == 34){
                    return _ApiCode::SUCCESS;
                }
                else {

                    $message = 'Đơn hàng của bạn đã bị Alium huỷ ở giai đoạn ' . $order->status->stt_valueF .
                        '.Vui lòng vào mục Quản lý đơn hàng để kiểm tra đơn hàng.';

//                  $url = route('frontend.order.getDetail',$order->od_code);
                    $url = '/orders/' . $order->od_code;
                    $title = 'Đơn hàng đã hủy';
                    $name = $order->od_code . ' (' . $order->product->prd_name . ' - ' . $order->od_quantity . ' chiếc)';
                    $action = 'Xem chi tiết';
                    $image = '/img/order-template.png';
                    if (count($order->image) > 0) {
                        $image = Common::GetThumb($order->image[0]->img_src);
                    }
                    $type = $order->od_status;
                    $userOrder = User::find($order->od_createdBy);
                    $contentNotify = [
                        'code'=>$order->od_code,
                        'cate' => 1,
                        'user' => $order->od_createdBy,
                        'url' => $url,
                        'type' => $type,
                        'title' => $title,
                        'message' => $message,
                        'name' => $name,
                        'action' => $action,
                        'image' => $image
                    ];
                    Order::ChangeStatus($order, 34, '', $request->note);
                    $this->dal_order->cancelOrder($order->od_id);
                    Notification::send($userOrder, new OrderChange($contentNotify));
                    $this->sendFCMMessage($contentNotify);
                    Order_detail::where('od_order', $order->od_id)
                        ->where('od_type', 4)
                        ->where('od_name', 'Change status')
                        ->where('od_assigneeTo', 34)
                        ->update([
                            'od_coupon' => $request->reasonCancel,
                        ]);

                    $order->save();
                    return _ApiCode::SUCCESS;
                }
            }
            return _ApiCode::ERROR_UNKNOWN;
        } catch (\Exception $e) {
            return _ApiCode::ERROR_UNKNOWN;
        }
    }

    public function postChangeStatus($request){
        try {
            $orderId = intval($request->lbId);
            $currentOrder = $this->dal_order->getDetailOrder($orderId);

            $imageNote = '';
            $messageNote = $request->note;
            if(Input::file('imageOrder')) {
                foreach (Input::file('imageOrder') as $key => $file) {
                    $alias = $this->CommonUpload(DAL_Config::IMAGE_ALIAS_ORDER, $file);
                    if ($alias) {
                        $lstImage = Common::buildTagArray($imageNote);
                        array_push($lstImage,$alias);
                        $imageNote = implode(',',$lstImage);
                    }

                }
            }

            if ($currentOrder->od_status == 11) {
                $this->dal_order->deleteOrderDetailSuggest($orderId);
                $supplierSuggest = $this->dataOrderSuggest($request);
                foreach ($supplierSuggest as $supplier) {
                    $supplier['od_order'] = $orderId;
                    foreach ($currentOrder->suggest_uMake as $suggest){
                        if ($suggest->od_assigneeTo == $supplier['od_assigneeTo']){
                            $odDetail = unserialize($supplier['od_detail']);
                            $odDetailSuggest = unserialize($suggest->od_detail);
                            $odDetail['image'] = $odDetailSuggest['image'];
                            $odDetail['note'] = $odDetailSuggest['note'];
                            $supplier['od_detail'] = serialize($odDetail);
                        }
                    }
                    $this->dal_order->createOrderDetail($supplier);
                }

                Order::ChangeStatus($currentOrder,12,$imageNote, $messageNote);
            }

            $currentOrder->save();
            return _ApiCode::SUCCESS;
        } catch (\Exception $e) {
            //log exception
            activity()->performedOn(Order::getModel())
                ->causedBy(Auth::user())
                ->withProperties(['action' => 'postChangeStatus'])
                ->log("line ".$e->getLine()." file ".$e->getFile() ."\n".$e->getMessage());
            \Log::error($e->getMessage(),$e->getTrace());
            return _ApiCode::ERROR_UNKNOWN;
        }
    }

    public function postAssigneeOrder($request){
        $orderId = intval($request->lbId);
        $currentOrder = $this->dal_order->getDetailOrder($orderId);

        if ($currentOrder && $currentOrder->od_id && $request->sale){
            $currentOrder->od_sale = $request->sale;
            $currentOrder->save();

            $contentNotify = [
                'msTitle' => 'Đơn hàng mới được giao cho bạn',
                'msMessage' => sprintf('Đơn hàng %s - %s - %s đã được giao cho bạn',
                    $currentOrder->od_code, $currentOrder->product->prd_name, $currentOrder->demander->user_showName),
                'msUrl' => route('admin.sale.getChangeOrder',$currentOrder->od_id),
                'msSale' => $currentOrder->sale? $currentOrder->sale->user_showName : '',
                'saleId' => $currentOrder->sale? $currentOrder->od_sale: 0,
            ];
            $sale = User::find($currentOrder->od_sale);
            if ($sale && $sale->user_email &&
                filter_var($sale->user_email, FILTER_VALIDATE_EMAIL)) {
                dispatch(new OrderChangeSale($contentNotify, $currentOrder->od_sale));
            }

            return _ApiCode::SUCCESS;
        }
        return _ApiCode::ERROR_UNKNOWN;
    }

    public function postAssigneeSupplierEmployeeOrder($request){
        $orderId = intval($request->lbId);
        $currentOrder = $this->dal_order->getDetailOrder($orderId);

        if ($currentOrder && $currentOrder->od_id && $request->supplier){
            $currentOrder->od_supplier = $request->supplier;
            $currentOrder->save();

            $contentNotify = [
                'msTitle' => 'Đơn hàng mới được giao cho bạn',
                'msMessage' => sprintf('Đơn hàng %s - %s đã được giao cho bạn',
                    $currentOrder->od_code, $currentOrder->product->prd_name),
                'msUrl' => route('admin.supplier.getChangeOrderSupplier',$currentOrder->od_id),
                'msSale' => '',
                'msSupplier' => $currentOrder->od_supplier,
            ];
            
            $supplier = User::find($currentOrder->od_supplier);
            if ($supplier && $supplier->user_email &&
                filter_var($supplier->user_email, FILTER_VALIDATE_EMAIL)) {
                dispatch(new OrderChangeSupplier($contentNotify));
            }

            return _ApiCode::SUCCESS;
        }
        return _ApiCode::ERROR_UNKNOWN;
    }

    public function postAssigneeSupplierOrder($request){
        try {
            $od_id = $request->lbId;
            $currentOrder = $this->dal_order->getDetailOrder($od_id);
            $lst_supplier = $request->supplier;

            if (($currentOrder->od_status == 36 || $currentOrder->od_status == 10)
                && strlen($lst_supplier) > 0) {
                $lst_supplier = explode(",", $lst_supplier);

                $message = 'Đơn hàng đang trong quá trình nhận báo giá';
                $url = $currentOrder->od_code;
                $title = 'Nhận đấu thầu đơn hàng';
                $name = $currentOrder->od_code . ' (' . $currentOrder->product->prd_name . ' - ' . $currentOrder->od_quantity . ' chiếc)';
                $action = 'Xem chi tiết';
                $image = '';
                if (count($currentOrder->image) > 0) {
                    $image = $currentOrder->image[0]->img_src;
                }
                $contentNotify = [
                    'code' => $currentOrder->od_code,
                    'cate' => 2,
                    'user' => $currentOrder->od_createdBy,
                    'url' => $url,
                    'type' => 101,
                    'title' => $title,
                    'message' => $message,
                    'name' => $name,
                    'action' => $action,
                    'image' => $image
                ];
                $contentMail = [
                    'msTitle' => 'Đơn hàng ' . $currentOrder->od_code . ' - ' . $currentOrder->product->prd_name
                        . ' đang trong quá trình nhận báo giá',
                    'msMessage' => 'Đơn hàng ' . $currentOrder->od_code . ' - ' . $currentOrder->product->prd_name
                        . ' đang trong quá trình nhận báo giá',
                    'msUrl' => _ObjectType::URL_WEB_SUPPLIER . _ObjectType::PATH_MANAGER_ORDER,
                    'msSale' => '',
                ];
                if ($currentOrder && $currentOrder->od_id) {
                    \DB::transaction(function () use ($lst_supplier, $od_id, $contentNotify, $currentOrder, $contentMail) {
                        foreach ($lst_supplier as $sp_id) {
                            $existOrderSp = Order_supplier::where('order_id', $od_id)
                                ->where('sp_id', $sp_id)->first();
                            if ($existOrderSp == null) {
                                Order_supplier::create([
                                    'order_id' => $od_id,
                                    'sp_id' => $sp_id,
                                    'status' => 1
                                ]);
                                $supplier = Supplier::find($sp_id);
                                $user = User::find((int)$supplier->sp_manager);
                                if ($user != null && $user->user_id != $currentOrder->od_createdBy) {
                                    Notification::send($user, new OrderChange($contentNotify));
                                    $this->sendFCMMessage($contentNotify);
                                }
                                if ($supplier && $supplier->sp_email &&
                                    filter_var($supplier->sp_email, FILTER_VALIDATE_EMAIL)) {
                                    dispatch(new OrderChangeFactory($contentMail, $sp_id));
                                }
                            }
                        }
                    });
                    $odContent = unserialize($currentOrder->od_content);
                    $odContent['price_factory'] = $request->txtPriceFactory;
                    $currentOrder->od_content = serialize($odContent);

                    if ($currentOrder->od_status != 10) {
                        Order::ChangeStatus($currentOrder, 10);
                    }
                    $currentOrder->save();
                    return _ApiCode::SUCCESS;
                }
            }
            return _ApiCode::ERROR_UNKNOWN;
        } catch (\Exception $ex) {
            return _ApiCode::ERROR_UNKNOWN;
        }
    }

    public function postEditOrder($request){
        $orderId = intval($request->lbId);
        $currentOrder = $this->dal_order->getDetailOrder($orderId);
        $orderData = $this->dataOrderDetail($request,unserialize($currentOrder->od_content));

        //create order
        if ($this->dal_order->updateOrder($orderId,$orderData)){
            //upload image
//            $this->dal_order->deleteOrderImage($orderId);
            $this->uploadOrderImage($currentOrder);

            $this->dal_order->deleteOrderDetailSize($orderId);

            //create detail order for quanlity/size
            $sizeOrderDetail = $this->dataOrderSize($currentOrder, $request);
            foreach ($sizeOrderDetail as $orderDetail) {
                $this->dal_order->createOrderDetail($orderDetail);
            }

//            $this->createOrderNote($currentOrder,$request->txtNote);
            return _ApiCode::SUCCESS;
        }
        return _ApiCode::ERROR_UNKNOWN;
    }

    public function getSearchOrder(){
        $result = array();
        if(isset($_GET['q'])) {
            $search = trim(mb_strtolower($_GET['q']));
            $lstOrder = Searchy::search('order')->fields('od_code','od_name','od_phone','od_email')
                ->query($search)->getQuery()
                ->whereNotIn('od_status',[DAL_Config::STATUS_DELETED])
                ->get();
        }
        else
            $lstOrder = Order::whereNotIn('od_status',[DAL_Config::STATUS_DELETED])
                ->paginate(DAL_Config::NUM_PER_PAGE_ORDER);
        foreach ($lstOrder as $order){
            array_push($result,['id'=>$order->od_id,'text'=>$order->od_code. ' - ' .$order->od_name]);
        }
        return $result;
    }

    public function genOrderCode($id) {
        $dateCreate = Carbon::now();
        $numSupplier = $this->dal_order->getCountByMonth($id);
        return 'DH'.$dateCreate->format('ymd').$numSupplier;
    }

    public function dataOrderSize($order, $request){
        return [
            [
                'od_order' => $order->od_id,
                'od_type' => 2,
                'od_name' => 'XS',
                'od_quantity' => intval($request->sizeXS),
                'od_priority' => 1,
            ],
            [
                'od_order' => $order->od_id,
                'od_type' => 2,
                'od_name' => 'S',
                'od_quantity' => intval($request->sizeS),
                'od_priority' => 2,
            ],
            [
                'od_order' => $order->od_id,
                'od_type' => 2,
                'od_name' => 'M',
                'od_quantity' => intval($request->sizeM),
                'od_priority' => 3,
            ],
            [
                'od_order' => $order->od_id,
                'od_type' => 2,
                'od_name' => 'L',
                'od_quantity' => intval($request->sizeL),
                'od_priority' => 4,
            ],
            [
                'od_order' => $order->od_id,
                'od_type' => 2,
                'od_name' => 'XL',
                'od_quantity' => intval($request->sizeXL),
                'od_priority' => 5,
            ]
        ];
    }

    public function dataOrderSuggest($request){
        $totalProduct = $this->dataOrderTotalProduct($request);
        $imageNote1 = ''; $imageNote2 = ''; $imageNote3 = '';
        if(Input::file('imageOrder1')) {
            foreach (Input::file('imageOrder1') as $key => $file) {
                $alias = $this->CommonUpload(DAL_Config::IMAGE_ALIAS_ORDER, $file);
                if ($alias) {
                    $lstImage = Common::buildTagArray($imageNote1);
                    array_push($lstImage,$alias);
                    $imageNote1 = implode(',',$lstImage);
                }

            }
        }
        if(Input::file('imageOrder2')) {
            foreach (Input::file('imageOrder2') as $key => $file) {
                $alias = $this->CommonUpload(DAL_Config::IMAGE_ALIAS_ORDER, $file);
                if ($alias) {
                    $lstImage = Common::buildTagArray($imageNote2);
                    array_push($lstImage,$alias);
                    $imageNote2 = implode(',',$lstImage);
                }

            }
        }
        if(Input::file('imageOrder3')) {
            foreach (Input::file('imageOrder3') as $key => $file) {
                $alias = $this->CommonUpload(DAL_Config::IMAGE_ALIAS_ORDER, $file);
                if ($alias) {
                    $lstImage = Common::buildTagArray($imageNote3);
                    array_push($lstImage,$alias);
                    $imageNote3 = implode(',',$lstImage);
                }

            }
        }

        return [[
            'od_type' => 1,
            'od_name' => 'supplier suggest',
            'od_assigneeTo' => $request->sltSuplier1,
            'od_priceUnit' => doubleval($request->txtPriceUnit1),
            'od_priceNow' => $totalProduct * doubleval($request->txtPriceUnit1),
            'od_price' => $totalProduct * doubleval($request->txtPriceUnit1),
            'od_priority' => 1,
            'od_detail' => serialize([
                'image' => $imageNote1,
                'note' => $request->note1,
                'time_template' => $request->txtTimeTemplate1,
                'price_template' => $request->txtPriceTemplate1,
                'time_finish' => $request->txtTimeFinish1,
                'material' => $request->txtMaterial1,
                'payment1' => str_replace(',','',$request->payment11),
                'payment2' => str_replace(',','',$request->payment12),
                'payment3' => str_replace(',','',$request->payment13),
            ])
        ],[
            'od_type' => 1,
            'od_name' => 'supplier suggest',
            'od_assigneeTo' => $request->sltSuplier2,
            'od_priceUnit' => doubleval($request->txtPriceUnit2),
            'od_priceNow' => $totalProduct * doubleval($request->txtPriceUnit2),
            'od_price' => $totalProduct * doubleval($request->txtPriceUnit2),
            'od_priority' => 2,
            'od_detail' => serialize([
                'image' => $imageNote2,
                'note' => $request->note2,
                'time_template' => $request->txtTimeTemplate2,
                'price_template' => $request->txtPriceTemplate2,
                'time_finish' => $request->txtTimeFinish2,
                'material' => $request->txtMaterial2,
                'payment1' => str_replace(',','',$request->payment21),
                'payment2' => str_replace(',','',$request->payment22),
                'payment3' => str_replace(',','',$request->payment23),
            ])
        ],[
            'od_type' => 1,
            'od_name' => 'supplier suggest',
            'od_assigneeTo' => $request->sltSuplier3,
            'od_priceUnit' => doubleval($request->txtPriceUnit3),
            'od_priceNow' => $totalProduct * doubleval($request->txtPriceUnit3),
            'od_price' => $totalProduct * doubleval($request->txtPriceUnit3),
            'od_priority' => 3,
            'od_detail' => serialize([
                'image' => $imageNote3,
                'note' => $request->note3,
                'time_template' => $request->txtTimeTemplate3,
                'price_template' => $request->txtPriceTemplate3,
                'time_finish' => $request->txtTimeFinish3,
                'material' => $request->txtMaterial3,
                'payment1' => str_replace(',','',$request->payment31),
                'payment2' => str_replace(',','',$request->payment32),
                'payment3' => str_replace(',','',$request->payment33),
            ])
        ]];
    }

    public function dataOrderDetail($request, $_odContent=[]){
        $dt = Carbon::parse($request->txtDate)->toDateString();
        //generate type order from bill, template, other require
        $orderType = Order::setType([
            'resource' => 0,
            'bill' => $request->rdBill,
            'template' => $request->rdTemplate,
            'otherRequire' => $request->rdOther,
            'liveTemplate' => $request->liveTemplate,
        ]);

        //check require template enable or not
        $requireTemplate = false;
        if ($request->rdTemplate) $requireTemplate = true;

        $totalProduct = $this->dataOrderTotalProduct($request);

        //create detail order for supplier suggest
        $selectedSupplier = intval($request->supplier);
        $supplierSuggest = $this->dataOrderSuggest($request);

        $totalPrice = 0;
        $priceUnitSelected = 0;

        $orderData = [
            'od_name' => $request->txtName,
            'od_phone' => $request->txtPhone,
            'od_email' => $request->txtEmail,
            'od_country' => intval($request->sltCountry),
            'od_city' => intval($request->sltCity),
            'od_district' => intval($request->sltDistrict),
            'od_address' => $request->txtAddress,
            'od_postalCode' => intval($request->txtCode),
            'od_quality' => intval($request->sltQuality),
            'od_quantity' => $totalProduct,
            'od_product' => $request->sltProduct,
            'od_requiredType' => implode(',',$request->sltRequire),
            'od_total' => $totalPrice,
            'od_type' => $orderType,
            'od_message' => $request->txtMessage,
            'od_requiredDate' => $dt,
            'od_wantedPrice' => doubleval($request->txtPrice),
            'od_priceUnit' => $priceUnitSelected,
        ];

        if ($request->sltPaymentMethod)
            $orderData['od_paymentMethod'] = $request->sltPaymentMethod;
        if ($request->txtPriceTemplate)
            $orderData['od_templatePrice'] = doubleval($request->txtPriceTemplate);
        if ($request->txtPaid)
            $orderData['od_paid'] = doubleval($request->txtPaid);
        if ($request->sltStatus)
            $orderData['od_status'] = $request->sltStatus;
        if ($request->sltUser)
            $orderData['od_createdBy'] = $request->sltUser;
        if ($selectedSupplier && $selectedSupplier > 0)
            $orderData['od_assigneeTo'] = $supplierSuggest[$selectedSupplier-1]['od_assigneeTo'];

        return $orderData;
    }

    public function dataOrderTotalProduct($request) {
        //caculate total number need to pay
        $numTotalBySize =  intval($request->sizeXS) + intval($request->sizeS) + intval($request->sizeM)
            + intval($request->sizeL) + intval($request->sizeXL);
        if ($numTotalBySize <= 0) return $request->sizeTotal;
        else return $numTotalBySize;
    }

    public function createOrderNote($order, $note){
        //create detail order for note
        $this->dal_order->createOrderDetail([
            'od_order' => $order->od_id,
            'od_type' => 3,
            'od_name' => 'Note',
            'od_detail' => $note,
            'od_assigneeTo' => \Auth::user()->user_id,
            'od_priority' => 1,
        ]);
    }

    public function postUpdateNote($request){
        $currentUser = Auth::user();
        if ($this->dal_order->createOrderDetail([
            'od_order' => $request->order,
            'od_type' => 3,
            'od_name' => 'Note',
            'od_detail' => $request->note,
            'od_assigneeTo' => $currentUser->user_id,
            'od_priority' => 1,
        ])) {
            $currentOrder = Order::find($request->order);

            $contentNotify = [
                'msTitle' => $currentOrder->od_code.'_Thay đổi nội dung ghi chú đơn hàng',
                'msMessage' => 'Đơn hàng ' .$currentOrder->od_code. ' đã được thay đổi nội dung ghi chú, truy cập để xem chi tiết',
                'msUrl' => route('admin.order.changeStatus',$currentOrder->od_id),
                'msSale' => '',
            ];
            if (!$currentUser->hasPermissionTo('sale manager')) {
                dispatch(new OrderChangeAlium($contentNotify));
            }

            if ($currentOrder->od_sale != $currentUser->user_id) {
                $contentNotify['msUrl'] = route('admin.sale.getChangeOrder', $currentOrder->od_id);
                $user_sale = User::find($currentOrder->od_sale);
                if ($user_sale && $user_sale->user_email &&
                    filter_var($user_sale->user_email, FILTER_VALIDATE_EMAIL)) {
                    dispatch(new OrderChangeSale($contentNotify, $currentOrder->od_sale));
                }
            }

            if ($currentOrder->od_supplier != $currentUser->user_id) {
                $contentNotify['msUrl'] = route('admin.supplier.getChangeOrder', $currentOrder->od_id);
                $contentNotify['msSupplier'] = $currentOrder->od_supplier;
                $user_supplier = User::find($currentOrder->od_supplier);
                if ($user_supplier && $user_supplier->user_email &&
                    filter_var($user_supplier->user_email, FILTER_VALIDATE_EMAIL)) {
                    dispatch(new OrderChangeSupplier($contentNotify));
                }
            }

            return response()->json(Common::buildApiResponse([]));
        }
    }

    public function getListOrderSale(){
        $user = Auth::user();
        if ($user->can('sale')){
            $search = isset($_GET['search']) ? $_GET['search'] : '';
            if($search != '') {
                $query = Searchy::search('order')->fields('od_code')
                    ->query($search)->getQuery()
                    ->where('od_sale',$user->user_id)
                    ->whereNotIn('od_status',[DAL_Config::STATUS_DELETED, 101]);
                if(isset($_GET['filter']) && $_GET['filter'] > 0){
                    $lstStatus = Order_status::where('stt_parent',$_GET['filter'])->pluck('stt_id');
                    $query = $query->whereIn('od_status',$lstStatus);
                }
                $query = $query->orderBy('created_at','desc');
                return Order::hydrate($query->limit(30)->get()->toArray());
            }
            $query = Order::where('od_sale',$user->user_id);
            if(isset($_GET['filter']) && $_GET['filter'] > 0){
                $lstStatus = Order_status::where('stt_parent',$_GET['filter'])->pluck('stt_id');
                $query = $query->whereIn('od_status',$lstStatus);
            }
            return $query->orderBy('created_at','desc')->paginate(30);
        }
        return [];
    }

    public function getChangeOrderSale($odId){
        $user = Auth::user();
        if ($user->can('sale')){
            $order = Order::find($odId);
            if ($order && $order->od_sale == $user->user_id){
                return $order;
            }
        }
        return null;
    }

    public function postChangeOrderSale($request){
        try {
            $orderId = intval($request->lbId);
            $currentOrder = $this->dal_order->getDetailOrder($orderId);

            $imageNote = '';
            $messageNote = $request->note;
            if(Input::file('imageOrder')) {
                foreach (Input::file('imageOrder') as $key => $file) {
                    $alias = $this->CommonUpload(DAL_Config::IMAGE_ALIAS_ORDER, $file);
                    if ($alias) {
                        $lstImage = Common::buildTagArray($imageNote);
                        array_push($lstImage,$alias);
                        $imageNote = implode(',',$lstImage);
                    }

                }
            }

            //first payment
            if ($currentOrder->od_status == 14) {

                $this->dal_order->createOrderDetail([
                    'od_type' => 5,
                    'od_image' => $imageNote,
                    'od_order' => $orderId,
                    'od_name' => 'Payment',
                    'od_detail' => serialize([
                        'payment' => $request->payment,
                        'note' => $messageNote
                    ]),
                    'od_priority' => 1,
                ]);
                if ($currentOrder->orderType['template']) {
                    Order::ChangeStatus($currentOrder,15, $imageNote,$messageNote);
                }
                else {
                    Order::ChangeStatus($currentOrder,35, $imageNote,$messageNote);
                }
                $currentOrder->od_paid = $currentOrder->od_paid + $request->payment;
            }

            // second payment
            if ($currentOrder->od_status == 20) {
                $this->dal_order->createOrderDetail([
                    'od_type' => 5,
                    'od_order' => $orderId,
                    'od_name' => 'Payment',
                    'od_detail' => serialize([
                        'payment' => $request->payment,
                        'note' => $messageNote
                    ]),
                    'od_priority' => 2,
                    'od_image' => $imageNote,
                ]);

                Order::ChangeStatus($currentOrder,35, $imageNote,$messageNote);
                $currentOrder->od_paid = $currentOrder->od_paid + $request->payment;

            }

            //change to transport if full paid
            if ($currentOrder->od_status == 27 && $currentOrder->od_total<=$currentOrder->od_paid) {
                Order::ChangeStatus($currentOrder,29, $imageNote,$messageNote);
            }

            // third payment
            if ($currentOrder->od_status == 28 && $currentOrder->od_total-$currentOrder->od_paid > 0) {
                $this->dal_order->createOrderDetail([
                    'od_type' => 5,
                    'od_order' => $orderId,
                    'od_name' => 'Payment',
                    'od_detail' => serialize([
                        'payment' => $request->payment,
                        'note' => $messageNote
                    ]),
                    'od_priority' => 3,
                    'od_image' => $imageNote,
                ]);

                $currentOrder->od_paid = $currentOrder->od_paid + $request->payment;
                Order::ChangeStatus($currentOrder,29, $imageNote,$messageNote);
            }

            if ($currentOrder->od_status == 9) {
                $orderData = $this->dataOrderDetail($request);
                if ($this->dal_order->updateOrder($orderId,$orderData)){
                    //upload image
                    $this->uploadOrderImage($currentOrder);
                }
                Order::ChangeStatus($currentOrder,36, $imageNote,$messageNote);
                return _ApiCode::SUCCESS;
            }

            if ($currentOrder->od_status == 16) {
                //not yet "Sửa mẫu"
                Order::ChangeStatus($currentOrder,19, $imageNote,$messageNote);
            }

            if ($currentOrder->od_status == 18) {
                Order::ChangeStatus($currentOrder,19, $imageNote,$messageNote);
            }

            if ($currentOrder->od_status == 30) {
                Order::ChangeStatus($currentOrder,33, $imageNote,$messageNote);
            }

            /* dont update message from customer
            if($request->txtMessage != $currentOrder->od_message){
                $currentOrder->od_message = $request->txtMessage;

                $contentNotify = [
                    'msTitle' => 'Thay đổi nội dung ghi chú đơn hàng',
                    'msMessage' => 'Đơn hàng ' .$currentOrder->od_code. ' đã được thay đổi nội dung ghi chú từ khách hàng, truy cập để xem chi tiết',
                    'msUrl' => route('admin.order.changeStatus',$currentOrder->od_id),
                    'msSale' => '',
                ];
                dispatch(new OrderChangeAlium($contentNotify));

                $contentNotify['msUrl'] = route('admin.sale.getChangeOrder',$currentOrder->od_id);
                dispatch(new OrderChangeSale($contentNotify, $currentOrder->od_sale));

                $contentNotify['msUrl'] = route('admin.supplier.getChangeOrder',$currentOrder->od_id);
                $contentNotify['msSupplier'] = $currentOrder->od_supplier;
                dispatch(new OrderChangeSupplier($contentNotify));
            }
            */

            $currentOrder->save();
            return _ApiCode::SUCCESS;
        } catch (\Exception $e) {
            //log exception
            activity()->performedOn(Order::getModel())
                ->causedBy(Auth::user())
                ->withProperties(['action' => 'postChangeOrderSale'])
                ->log("line ".$e->getLine()." file ".$e->getFile() ."\n".$e->getMessage());
            \Log::error($e->getMessage(),$e->getTrace());
            return _ApiCode::ERROR_UNKNOWN;
        }
    }

    public function getListOrderSupplier(){
        $user = Auth::user();
        if ($user->can('supplier')){
            $search = isset($_GET['search']) ? $_GET['search'] : '';
            if($search != '') {
                $query = Searchy::search('order')->fields('od_code')
                    ->query($search)->getQuery()
                    ->where('od_supplier',$user->user_id)
                    ->whereNotIn('od_status',[DAL_Config::STATUS_DELETED, 101]);
                if(isset($_GET['filter']) && $_GET['filter'] > 0){
                    $lstStatus = Order_status::where('stt_parent',$_GET['filter'])->pluck('stt_id');
                    $query = $query->whereIn('od_status',$lstStatus);
                }
                $query = $query->orderBy('created_at','desc');
                return Order::hydrate($query->limit(30)->get()->toArray());
            }
            $query = Order::where('od_supplier',$user->user_id);
            if(isset($_GET['filter']) && $_GET['filter'] > 0){
                $lstStatus = Order_status::where('stt_parent',$_GET['filter'])->pluck('stt_id');
                $query = $query->whereIn('od_status',$lstStatus);
            }
            return $query->orderBy('created_at','desc')->paginate(30);
        }
        return [];
    }

    public function getChangeOrderSupplier($odId){
        $user = Auth::user();
        if ($user->can('supplier')){
            $order = Order::find($odId);
            if ($order && $order->od_supplier == $user->user_id){
                return $order;
            }
        }
        return null;
    }

    public function postChangeOrderSupplier($request){
        try {
            $orderId = intval($request->lbId);
            $currentOrder = $this->dal_order->getDetailOrder($orderId);


            $imageNote = '';
            $messageNote = $request->note;
            if(Input::file('imageOrder')) {
                foreach (Input::file('imageOrder') as $key => $file) {
                    $alias = $this->CommonUpload(DAL_Config::IMAGE_ALIAS_ORDER, $file);
                    if ($alias) {
                        $lstImage = Common::buildTagArray($imageNote);
                        array_push($lstImage,$alias);
                        $imageNote = implode(',',$lstImage);
                    }

                }
            }

            if ($currentOrder->od_status == 10) {
                $this->dal_order->deleteOrderDetailSuggest($orderId,8);
                $supplierSuggest = $this->dataOrderSuggest($request);
                foreach ($supplierSuggest as $supplier) {
                    $supplier['od_order'] = $orderId;
                    $supplier['od_type'] = 8;
                    $this->dal_order->createOrderDetail($supplier);
                }

                Order::ChangeStatus($currentOrder,11,$imageNote, $messageNote);
            }

            if ($currentOrder->od_status == 15) {
                Order::ChangeStatus($currentOrder,16, $imageNote,$messageNote);
            }

            if ($currentOrder->od_status == 17) {
                Order::ChangeStatus($currentOrder,18, $imageNote,$messageNote);
            }

            if (in_array($currentOrder->od_status,[35,21,22,23,24,25,26])) {
                if ($currentOrder->od_total-$currentOrder->od_paid > 0)
                    Order::ChangeStatus($currentOrder,27, $imageNote,$messageNote);
                else
                    Order::ChangeStatus($currentOrder,29, $imageNote,$messageNote);
            }

            /* dont update message from customer
            if($request->txtMessage != $currentOrder->od_message){
                $currentOrder->od_message = $request->txtMessage;

                $contentNotify = [
                    'msTitle' => 'Thay đổi nội dung ghi chú đơn hàng',
                    'msMessage' => 'Đơn hàng ' .$currentOrder->od_code. ' đã được thay đổi nội dung ghi chú từ khách hàng, truy cập để xem chi tiết',
                    'msUrl' => route('admin.order.changeStatus',$currentOrder->od_id),
                    'msSale' => '',
                ];
                dispatch(new OrderChangeAlium($contentNotify));

                $contentNotify['msUrl'] = route('admin.sale.getChangeOrder',$currentOrder->od_id);
                dispatch(new OrderChangeSale($contentNotify, $currentOrder->od_sale));

                $contentNotify['msUrl'] = route('admin.supplier.getChangeOrder',$currentOrder->od_id);
                $contentNotify['msSupplier'] = $currentOrder->od_supplier;

                dispatch(new OrderChangeSupplier($contentNotify));
            }
            */
            $currentOrder->save();
            return _ApiCode::SUCCESS;
        } catch (\Exception $e) {
            //log exception
            activity()->performedOn(Order::getModel())
                ->causedBy(Auth::user())
                ->withProperties(['action' => 'postChangeOrderSupplier'])
                ->log("line ".$e->getLine()." file ".$e->getFile() ."\n".$e->getMessage());
            \Log::error($e->getMessage(),$e->getTrace());
            return _ApiCode::ERROR_UNKNOWN;
        }

    }

    //file upload via dropzone
    public function uploadImageOrder($request){
        $imageInfo = getimagesize( $_FILES['file']['tmp_name'] );
        if ( $imageInfo['mime'] == ( "image/png" ) ||
            $imageInfo['mime'] == ( "image/jpeg" ) ||
            $imageInfo['mime'] == ( "image/gif" ) ||
            $imageInfo['mime'] == ( "image/jpg" ) ||
            $imageInfo['mime'] == ( "image/bmp" ) ) {

            $file = $file = Input::file('file');
            $destination = 'order';
            $alias = $this->CommonUpload($destination, $file);
            if($alias){
                $this->imageCrop->MakeOrderThumb($alias);
                $imageModel = $this->dal_order->createImageOrder([
                    'img_src' => '/'.$alias,
                ]);
                return response()->json(
                    array(
                        "uploaded" => 1,
                        "img_id" => $imageModel->img_id,
                    )
                );
            }
            else{
                return response()->json(
                    array(
                        "uploaded" => 0,
                        "img_id" => 0
                    )
                );
            }
        }
    }

    //file upload via submit form
    public function uploadOrderImage($order){
        if(Input::file('imageOrder')) {
            foreach (Input::file('imageOrder') as $key => $file) {
                $alias = $this->CommonUpload(DAL_Config::IMAGE_ALIAS_ORDER, $file);
                if ($alias) {
                    $this->imageCrop->MakeOrderThumb($alias);
                    $this->dal_order->createImageOrder([
                        'img_order' => $order->od_id,
                        'img_src' => $alias,
                    ]);
                }

            }
        }
    }

    public function getDeleteImageOrder($imgId){
        try {
            $image = $this->dal_order->getDetailImage($imgId);
            $this->imageCrop->RemoveThumb($image->img_src);
            $this->dal_order->deleteImageOrder($imgId);
            return _ApiCode::SUCCESS;
        } catch (\Exception $e) {
            // log exception
            return _ApiCode::ERROR_UNKNOWN;
        }
    }
}