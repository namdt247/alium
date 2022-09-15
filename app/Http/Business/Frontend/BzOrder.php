<?php
/**
 * Created by PhpStorm.
 * User: QuanVH
 * Date: 17/02/2017
 * Time: 21:54 CH
 */

namespace App\Http\Business\Frontend;


use App\Helper\_ApiCode;
use App\Helper\_ObjectType;
use App\Helper\Common;
use App\Jobs\OrderChangeAlium;
use App\Jobs\OrderChangeFactory;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Order_status;
use App\Models\Order_supplier;
use App\Models\Rating;
use App\Models\Supplier;
use App\Models\User;
use App\Notifications\OrderChange;
use Carbon\Carbon;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class BzOrder extends BzFrontend
{
    public function postAddOrder($request){
        $orderData = $this->dataOrderDetail($request);

        //create order
        if ($newOrder = $this->dal_order->createOrder($orderData)){
            //upload image
            $listImageId = $request->imgId;
            $arrImageId = explode(',', $listImageId);
            foreach ($arrImageId as $imgId) {
                if ($imgId > 0) $this->dal_order->updateImageOrder($imgId, array(
                    'img_order' => $newOrder->od_id,
                ));
            }

            $newOrder->od_code = $this->genOrderCode($newOrder->od_id);
            $newOrder->save();

            Order::ChangeStatus($newOrder,$newOrder->od_status);
            return $newOrder;
        }
        return false;
    }

    public function dataOrderDetail($request){
//        $dt = Carbon::parse($request->deliverDate)->toDateString();
        if($request->deliverDate) {
            $dt = Carbon::createFromFormat('d/m/Y', $request->deliverDate);
        }else $dt = Carbon::parse()->toDateString();
        //generate type order from bill, template, other require
        $orderType = Order::setType([
            'resource' => 0,
            'bill' => $request->bill,
            'template' => $request->sample,
            'otherRequire' => $request->otherRequire,
            'liveTemplate' => $request->liveTemplate,
        ]);

        $totalProduct = $request->totalQuantity;

        $firstStatus = Order_status::where('stt_parent',0)
            ->orderBy('stt_order','asc')
            ->first('stt_id');

        $initialStatus = Order_status::where('stt_parent',$firstStatus->stt_id)
            ->orderBy('stt_order','asc')
            ->first('stt_id')->stt_id;

        $orderData = [
            'od_name' => $request->name,
            'od_phone' => $request->phone,
            'od_email' => $request->email,
            'od_country' => intval($request->country),
            'od_city' => intval($request->city),
            'od_district' => intval($request->district),
            'od_address' => $request->address,
            'od_postalCode' => intval($request->postal),
            'od_quality' => intval($request->quality),
            'od_quantity' => $totalProduct,
            'od_product' => $request->prdId,
            'od_status' => $initialStatus,
            'od_requiredType' => implode(',',$request->require),
            'od_type' => $orderType,
            'od_message' => $request->note,
            'od_requiredDate' => $dt,
            'od_wantedPrice' => doubleval($request->wantedPrice),
            'od_createdBy' => \Auth::user()->getAuthIdentifier(),
        ];
        return $orderData;
    }

    public function getListOrder(){
        $filter = [1,2,3,4,5,6];
        $tab = 0;
        if (isset($_GET['filter']) && intval($_GET['filter'] > 0)){
            $filter = Common::buildTagArray($_GET['filter']);
            $tab = $filter[0];
        }
        $lstStatus = Order_status::whereIn('stt_parent',$filter)
            ->pluck('stt_id');

        $lstOrder = Order::where('od_createdBy',Auth::user()->user_id)
            ->orderBy('created_at','desc')
            ->whereIn('od_status',$lstStatus)->paginate(10);
        return [
            'lstOrder' => $lstOrder,
            'sidebar' => 1,
            'tab' => $tab
        ];
    }

    public function getHistoryOrder(){
        $filter = [7,8];
        $tab = 0;

        if (isset($_GET['filter']) && intval($_GET['filter'] > 0)){
            $tab = intval($_GET['filter']);
            $filter = [$tab];
        }
        $lstStatus = Order_status::whereIn('stt_parent',$filter)
            ->pluck('stt_id');
        $lstOrder = Order::where('od_createdBy',Auth::user()->user_id)->orderBy('created_at','desc')
            ->whereIn('od_status',$lstStatus)->paginate(10);
        return [
            'lstOrder' => $lstOrder,
            'sidebar' => 2,
            'tab' => $tab
        ];
    }

    public function getDetailOrder($odCode){
        if (isset($_GET['notify']))
            DatabaseNotification::find($_GET['notify'])->markAsRead();

        $order = Order::where('od_code',$odCode)->first();
        $sidebar = 1;
        if ($order && $order->od_id) {
            if ($order->od_status == 14 || $order->od_status == 15 || $order->od_status == 16)
                $sidebar = 2;
            return [
                'order' => $order,
                'sidebar' => $sidebar,
            ];
        }
        return false;
    }

    public function getCancelOrder($odCode){
        try {
            $order = Order::where('od_code', $odCode)->first();
            if ($order->od_status == 34){
                return _ApiCode::SUCCESS;
            }
            else {
                $message = 'Đơn hàng của bạn đã bị huỷ ở giai đoạn ' . $order->status->stt_valueF .
                    '. Vui lòng vào mục Quản lý đơn hàng để kiểm tra đơn hàng.';

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
                    'cate' => 1,
                    'code' => $order->od_code,
                    'url' => $url,
                    'type' => $type,
                    'title' => $title,
                    'message' => $message,
                    'name' => $name,
                    'action' => $action,
                    'image' => $image
                ];
                Notification::send($userOrder, new OrderChange($contentNotify));
                $this->sendFCMMessage($contentNotify);

                Order::ChangeStatus($order, 34);
                $this->dal_order->cancelOrder($order->od_id);

                $contentNotify = [
                    'msTitle' => 'Đơn hàng ' . $order->od_code . ' - '
                        . $order->product->prd_name . ' - ' . $order->demander->user_showName
                        . ' đã hủy',
                    'msMessage' => 'Khách hàng ' . $order->demander->user_showName
                        . ' đã hủy đơn hàng ' . $order->od_code . ' - '
                        . $order->product->prd_name,
                    'msUrl' => route('admin.order.changeStatus', $order->od_id),
                    'msSale' => $order->sale ? $order->sale->user_showName : ''
                ];
                dispatch(new OrderChangeAlium($contentNotify));

                return _ApiCode::SUCCESS;
            }
        } catch (\Exception $e) {
            //log exception
            activity()->performedOn(Order::getModel())
                ->causedBy(Auth::user())
                ->withProperties(['action' => 'getCancelOrder'])
                ->log("line ".$e->getLine()." file ".$e->getFile() ."\n".$e->getMessage());
            \Log::error($e->getMessage(),$e->getTrace());
            return _ApiCode::ERROR_UNKNOWN;
        }
    }

    public function postPaymentOrder($code){
        try {
            $currentOrder = Order::where('od_code', $code)->first();
            if ($currentOrder && $currentOrder->od_id) {
                if ($currentOrder->od_status == 13) {
                    Order::ChangeStatus($currentOrder,14);
                }
                if ($currentOrder->od_status == 19) {
                    Order::ChangeStatus($currentOrder,20);
                }
                if ($currentOrder->od_status == 27) {
                    Order::ChangeStatus($currentOrder,28);
                }
                return _ApiCode::SUCCESS;
            }
            return _ApiCode::ERROR_UNKNOWN;
        } catch (\Exception $e) {
            //log exception
            activity()->performedOn(Order::getModel())
                ->causedBy(Auth::user())
                ->withProperties(['action' => 'postPaymentOrder'])
                ->log("line ".$e->getLine()." file ".$e->getFile() ."\n".$e->getMessage());
            \Log::error($e->getMessage(),$e->getTrace());
            return _ApiCode::ERROR_UNKNOWN;
        }
    }

    public function getReceivedOrder($odCode){
        try {
            $order = Order::where('od_code', $odCode)->first();
            if ($order && $order->od_id && $order->od_status == 29) {
                Order::ChangeStatus($order,30);

                $order->od_deliveredTime = Carbon::now();
                $order->save();

                return _ApiCode::SUCCESS;
            }
            return _ApiCode::ERROR_UNKNOWN;
        } catch (\Exception $e) {
            //log exception
            activity()->performedOn(Order::getModel())
                ->causedBy(Auth::user())
                ->withProperties(['action' => 'getReceivedOrder'])
                ->log("line ".$e->getLine()." file ".$e->getFile() ."\n".$e->getMessage());
            \Log::error($e->getMessage(),$e->getTrace());
            return _ApiCode::ERROR_UNKNOWN;
        }
    }

    public function postChooseSupplier($request){
        try {
            $orderCode = $request->order;
            $order = Order::where('od_code', $orderCode)->first();
            $supplierId = $request->supplier;
            if ($order && $order->od_id) {
                $suggest = Order_detail::where('od_order', $order->od_id)
                    ->where('od_type', 1)->where('od_assigneeTo', $supplierId)->first();
                if ($suggest) {
                    $suggestDetail = unserialize($suggest->od_detail);

                    $priceOrder = $suggest->od_priceUnit * $order->od_quantity;
                    $priceVat = 0; $priceTemplate = 0;
                    if ($order->orderType['bill']) $priceVat = 0.1 * $priceOrder;
                    if ($order->orderType['template']) $priceTemplate = $suggestDetail['price_template'];

                    $order->od_templatePrice = $suggestDetail['price_template'];
                    $order->od_assigneeTo = $supplierId;
                    $order->od_priceUnit = $suggest->od_priceUnit;

                    $total = $priceOrder + $priceTemplate + $priceVat;
                    $order->od_total = $total;

                    $odContent = unserialize($order->od_content);
                    $odContent['total_price'] = $total;
                    $odContent['price_order'] = $priceOrder;
                    $odContent['price_vat'] = $priceVat;
                    $odContent['price_template'] = $priceTemplate;
                    $odContent['time_finish'] = $suggestDetail['time_finish'];
                    $odContent['material'] = $suggestDetail['material'];
                    $odContent['payment_expected1'] = $suggestDetail['payment1'];
                    $odContent['payment_expected2'] = $suggestDetail['payment2'];
                    $odContent['payment_expected3'] = $suggestDetail['payment3'];
                    $order->od_content = serialize($odContent);

                    // update supplier selected
                    Order_supplier::where('order_id', $order->od_id)
                        ->where('sp_id', $supplierId)
                        ->update(['status' => 5]);

                    // update suppliers not selected
                    Order_supplier::where('order_id', $order->od_id)
                        ->where('status', 2)
                        ->update(['status' => 4]);

                    $contentMail = [
                        'msTitle' => 'Báo giá đơn hàng ' . $order->od_code . ' - ' . $order->product->prd_name
                            . ' của bạn không được chọn',
                        'msMessage' => 'Báo giá đơn hàng ' . $order->od_code . ' - ' . $order->product->prd_name
                            . ' của bạn không được chọn',
                        'msUrl' => _ObjectType::URL_WEB_SUPPLIER . _ObjectType::PATH_MANAGER_ORDER,
                        'msSale' => '',
                    ];
                    $list_supplier_id = Order_supplier::where('order_id', $order->od_id)
                        ->where('status', 4)->pluck('sp_id');
                    foreach ($list_supplier_id as $sp_id ) {
                        $supplier = Supplier::find($sp_id);
                        if ($supplier && $supplier->sp_email &&
                            filter_var($supplier->sp_email, FILTER_VALIDATE_EMAIL)) {
                            dispatch(new OrderChangeFactory($contentMail, $sp_id));
                        }
                    }

                    Order::ChangeStatus($order,13);
                    $order->save();

                    return _ApiCode::SUCCESS;
                }
            }
            return _ApiCode::ERROR_UNKNOWN;
        } catch (\Exception $e) {
            //log exception
            activity()->performedOn(Order::getModel())
                ->causedBy(Auth::user())
                ->withProperties(['action' => 'postChooseSupplier'])
                ->log("line ".$e->getLine()." file ".$e->getFile() ."\n".$e->getMessage());
            \Log::error($e->getMessage(),$e->getTrace());
            return _ApiCode::ERROR_UNKNOWN;
        }
    }

    public function postRateOrder($request){
        try {
            $order = Order::where('od_code', $request->order)->first();
            if ($order && $order->od_id && !$this->dal_order->checkUserRateOrder($order->od_id)) {
                if ($newRate = Rating::create([
                    'rate_star' => $request->star,
                    'rate_content' => $request->content,
                    'rate_targetType' => Order::class,
                    'rate_targetId' => $order->od_id,
                    'rate_authorType' => User::class,
                    'rate_authorId' => Auth::user()->user_id,
                ])) {
                    $supplier = $order->supplier;
                    if($supplier && $supplier->sp_id) {
                        $supplier->sp_rate = ($supplier->sp_rate * $supplier->sp_numRate + $request->star) / ($supplier->sp_numRate + 1);
                        $supplier->sp_numRate += 1;
                        $supplier->save();
                    }
                    return _ApiCode::SUCCESS;
                }
            }
            return _ApiCode::ERROR_UNKNOWN;
        } catch (\Exception $e) {
            //log exception
            activity()->performedOn(Order::getModel())
                ->causedBy(Auth::user())
                ->withProperties(['action' => 'postRateOrder'])
                ->log("line ".$e->getLine()." file ".$e->getFile() ."\n".$e->getMessage());
            \Log::error($e->getMessage(),$e->getTrace());
            return _ApiCode::ERROR_UNKNOWN;
        }
    }

    public function getReorder($odCode){
        $order = Order::where('od_code', $odCode)->first();
        if($order && $order->od_id){
            $newRequireDate = date("Y-m-d",
                time() + strtotime($order->od_requiredDate) - strtotime($order->created_at));
            if ($newOrder =  Order::create([
                "od_name" => $order->od_name,
                "od_locationId" => $order->od_locationId,
                "od_phone" => $order->od_phone,
                "od_email" => $order->od_email,
                "od_country" => $order->od_country,
                "od_city" => $order->od_city,
                "od_district" => $order->od_district,
                "od_address" => $order->od_address,
                "od_postalCode" => $order->od_postalCode,
                "od_quantity" => $order->od_quantity,
                "od_quality" => $order->od_quality,
                "od_product" => $order->od_product,
                "od_templatePrice" => $order->od_templatePrice,
                "od_createdBy" => $order->od_createdBy,
                "od_assigneeTo" => $order->od_assigneeTo,
                "od_priceUnit" => $order->od_priceUnit,
                "od_total" => $order->od_total,
                "od_paid" => 0,
                "od_requiredType" => $order->od_requiredType,
                "od_wantedPrice" => $order->od_wantedPrice,
                "od_paymentMethod" => $order->od_paymentMethod,
                "od_coupon" => $order->od_coupon,
                "od_parent" => $order->od_parent,
                "od_type" => $order->od_type,
                "od_message" => $order->od_message,
                "od_content" => $order->od_content,
                "od_requiredDate" => $newRequireDate,
                "od_sale" => $order->od_sale,
                "od_supplier" => $order->od_supplier
            ])){
                $newOrder->od_code = $this->genOrderCode($newOrder->od_id);
                foreach ($order->image as $orderImage) {
                    $this->dal_order->createImageOrder([
                        'img_order' => $newOrder->od_id,
                        'img_src' => $orderImage->img_src,
                        'img_name' => $orderImage->img_name,
                        'img_alias' => $orderImage->img_alias,
                        'img_status' => $orderImage->img_status,
                        'img_shape' => $orderImage->img_shape,
                    ]);
                }
                foreach ($order->order_detail as $detail) {
                    if ($detail->od_type == 5) break;
                    if ($detail->od_type == 4 && $detail->od_assigneeTo <= 5) break;
                    $this->dal_order->createOrderDetail([
                        'od_order' => $newOrder->od_id,
                        'od_type' => $detail->od_type,
                        'od_name' => $detail->od_name,
                        'od_quantity' => $detail->od_quantity,
                        'od_assigneeTo' => $detail->od_assigneeTo,
                        'od_price' => $detail->od_price,
                        'od_priceNow' => $detail->od_priceNow,
                        'od_coupon' => $detail->od_coupon,
                        'od_parent' => $detail->od_parent,
                        'od_priceUnit' => $detail->od_priceUnit,
                        'od_priority' => $detail->od_priority,
                        'od_status' => $detail->od_status,
                        'od_image' => $detail->od_image,
                        'od_detail' => $detail->od_detail
                    ]);
                }
                $newOrder->save();
                Order::ChangeStatus($newOrder, 13);

                return _ApiCode::SUCCESS;
            }
        }
        return _ApiCode::ERROR_UNKNOWN;
    }

    public function genOrderCode($id) {
        $dateCreate = Carbon::now();
        $numSupplier = $this->dal_order->getCountByMonth($id);
        return 'DH'.$dateCreate->format('ymd').$numSupplier;
    }
}