<?php
/**
 * Created by PhpStorm.
 * Project: Alium_main
 * User: quanvu
 * Date: 13/07/2019
 */


namespace App\Http\Business\API;


use App\Helper\_ApiCode;
use App\Helper\_ObjectType;
use App\Helper\Common;
use App\Http\Business\Helper;
use App\Http\DAL\DAL_Config;
use App\Jobs\OrderChangeAlium;
use App\Jobs\OrderChangeFactory;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Order_status;
use App\Models\Order_supplier;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Supplier;
use App\Models\User;
use App\Notifications\OrderChange;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Notification;

class BzOrder extends BzApi
{
    public function getListOrderByUser($userId, $state)
    {
        $query = Order::where('od_createdBy', $userId)
            ->whereNotIn('od_status', [DAL_Config::STATUS_DELETED]);
        $filter = [1, 2, 3, 4, 5, 6];
        if ($state == 'confirm') $filter = [1, 2];
        elseif ($state == 'pendingCharge') $filter = [3];
        elseif ($state == 'producing') $filter = [4, 5, 6];
        elseif ($state == 'finish') $filter = [7];
        elseif ($state == 'cancel') $filter = [8];
        elseif ($state == 'history') $filter = [7, 8];


        $lstStatus = Order_status::whereIn('stt_parent', $filter)
            ->pluck('stt_id');
        $lstOrder = $query->whereIn('od_status', $lstStatus)
            ->orderBy('created_at', 'desc')
            ->select(['od_id', 'od_code', 'od_product', 'od_priceUnit',
                'od_quantity', 'od_wantedPrice', 'od_status', 'created_at'])
            ->paginate(10);

        foreach ($lstOrder as $order) {
            $newContent = unserialize($order->od_content);
            if (is_array($newContent) && array_key_exists('price_factory', $newContent))
                $newContent['price_factory'] = 0;
            $order->od_content = $newContent;
        }
        return $lstOrder;
    }

    public function getListOrderBySupplier($spId, $state)
    {
        $lstOrder = [];
        try {
            $lstStatus = [];
            $bid = [];
            if ($state == 'all') {
                $lstStatus = range(3, 36);
                $bid = range(1,6);
            } elseif ($state == 'bid') {
                $lstStatus = [];
                $bid = [1];
            } elseif ($state == 'bidding') {
                $lstStatus = [13, 14];
                $bid = [2];
            } elseif ($state == 'quote') {
                $lstStatus = [13, 14];
                $bid = [1, 2];
            } elseif ($state == 'closed') {
                $lstStatus = [];
                $bid = [4, 6];
            } elseif ($state == 'cancel') {
                $lstStatus = [34];
                $bid = [3];
            }
            elseif ($state == 'sample') $lstStatus = range(15, 20);
            elseif ($state == 'produce') {
                $lstStatus = range(21, 26);
                array_push($lstStatus, 35);
            }
            elseif ($state == 'transport') $lstStatus = range(27, 32);
            elseif ($state == 'finish') $lstStatus = [33];
            elseif ($state == 'history') {
                $lstStatus = [33, 34];
                $bid = [3, 4, 6];
            }
            $lstBid = Order_supplier::where('sp_id', $spId)->whereIn('status', $bid)
                ->pluck('order_id');
            $lstOrder = Order::whereIn('od_id', $lstBid)
                ->orWhere(function ($query) use ($spId, $lstStatus) {
                    $query->where('od_assigneeTo', $spId)
                        ->whereIn('od_status', $lstStatus);
                })
                ->orderBy('created_at', 'desc')
                ->select(['od_id', 'od_code', 'od_product', 'od_priceUnit',
                    'od_quantity', 'od_wantedPrice', 'od_status', 'od_content', 'od_requiredDate', 'created_at'])
                ->paginate(10);
            foreach ($lstOrder as $order){
                $order->spStatus = $order->getStatusSPChoose($spId);
            }
        } catch (\Exception $e) {
            //log exception
            activity()->performedOn(Order::getModel())
                ->causedBy(Auth::user())
                ->withProperties(['action' => 'getListOrderBySupplier'])
                ->log("line " . $e->getLine() . " file " . $e->getFile() . "\n" . $e->getMessage());
            \Log::error($e->getMessage(), $e->getTrace());
        }
        return [
            'lstOrder' => $lstOrder,
            'totalOrderAll' => $this->totalOrderBySupplier($spId, [], range(1,6)),
            'totalOrderBid' => $this->totalOrderBySupplier($spId, [], [1]),
            'totalOrderBidding' => $this->totalOrderBySupplier($spId, [13, 14], [2]),
            'totalOrderSample' => $this->totalOrderBySupplier($spId, range(15, 20)),
            'totalOrderProduce' =>
                $this->totalOrderBySupplier($spId, [21,22,23,24,25,26,35]),
            'totalOrderTransport' => $this->totalOrderBySupplier($spId, range(27, 32)),
            'totalOrderFinish' => $this->totalOrderBySupplier($spId, [33]),
            'totalOrderCancel' => $this->totalOrderBySupplier($spId, [34], [3]),
            'totalOrderClosed' => $this->totalOrderBySupplier($spId, [], [4,6])
        ];
    }

    public function totalOrderBySupplier($spId, $lstStatus = [], $bid = [])
    {
        $lstBid = Order_supplier::where('sp_id', $spId)->whereIn('status', $bid)
            ->pluck('order_id');
        return Order::whereIn('od_id', $lstBid)
            ->orWhere(function ($query) use ($spId, $lstStatus) {
                $query->where('od_assigneeTo', $spId)
                    ->whereIn('od_status', $lstStatus);
            })
            ->count();
    }

    public function getListStatus()
    {
        return Order_status::where('stt_parent', 0)
            ->whereNotIn('stt_id', [8])->orderBy('stt_order')->with('sub_status')->get();
    }

    public function getDetailOrderSupplier($odCode, $customer=true)
    {
        $order = Order::where('od_code', $odCode)->with(['suggest', 'image'])->first();
        $supplier = Supplier::where('sp_manager', Auth::user()->user_id)->first();
        $lstPayment = $this->dal_order->getListPaymentOrder($order->od_id);
        foreach ($lstPayment as $payment) {
            $payment->od_detail = unserialize($payment->od_detail);
        }
        $order->payment = $lstPayment;
        $order->changeStatus =
            $this->dal_order->getListChangeStatusSupplier($order->od_id, $supplier->sp_id);
        $order->isRated = $this->dal_order->checkSupplierRateOrder($order->od_id);
        if ($customer) {
            $newContent = unserialize($order->od_content);
            if (is_array($newContent) && array_key_exists('price_factory', $newContent))
                $newContent['price_factory'] = 0;
            $order->od_content = $newContent;
        }
        return $order;
    }

    public function getDetailOrder($odCode, $customer=true)
    {
        $order = Order::where('od_code', $odCode)->with(['suggest', 'image'])->first();
        $lstPayment = $this->dal_order->getListPaymentOrder($order->od_id);
        foreach ($lstPayment as $payment) {
            $payment->od_detail = unserialize($payment->od_detail);
        }
        $order->payment = $lstPayment;
        $order->changeStatus = $this->dal_order->getListChangeStatus($order->od_id);
        $order->isRated = $this->dal_order->checkSupplierRateOrder($order->od_id);
        if ($customer) {
            $newContent = unserialize($order->od_content);
            if (is_array($newContent) && array_key_exists('price_factory', $newContent))
                $newContent['price_factory'] = 0;
            $order->od_content = $newContent;
        }
        return $order;
    }

    public function getDetailOrderCustomer($odCode, $spId)
    {
        $order = Order::where('od_code', $odCode)->first();
        return Order_detail::where('od_order', $order->od_id)
            ->where('od_type', 8)
            ->where('od_assigneeTo', $spId)->first();
    }

    public function getDetailOrderCustomerSP($odCode, $spId)
    {
        $order = Order::where('od_code', $odCode)->first();
        return Order_supplier::where('order_id', $order->od_id)
            ->where('sp_id', $spId)
            ->first();
    }

    public function getCancelOrder($odCode)
    {
        try {
            $order = Order::where('od_code', $odCode)->first();

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
                'user' => $order->od_createdBy,
                'url' => $url,
                'type' => $type,
                'title' => $title,
                'message' => $message,
                'name' => $name,
                'action' => $action,
                'image' => $image,
                'code' => $order->od_code,
            ];
            Notification::send($userOrder, new OrderChange($contentNotify));
            Helper::sendFCMMessage($contentNotify);
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
            return Common::buildApiResponse(["code" => $odCode], _ApiCode::SUCCESS);
        } catch (\Exception $e) {
            //log exception
            activity()->performedOn(Order::getModel())
                ->causedBy(\Auth::user())
                ->withProperties(['action' => 'getCancelOrder'])
                ->log("line " . $e->getLine() . " file " . $e->getFile() . "\n" . $e->getMessage());
            \Log::error($e->getMessage(), $e->getTrace());
            return Common::buildApiResponse([], _ApiCode::ERROR_UNKNOWN);
        }
    }

    public function processOrder($request)
    {
        try {
            $order = Order::where('od_code', $request->odCode)->first();
            $supplier = Supplier::where('sp_manager', Auth::user()->user_id)->first();
            if ($request->type == 'cancel') {
                // supplier cancel order status = 3
                Order_supplier::where('order_id', $order->od_id)
                    ->where('sp_id', $supplier->sp_id)
                    ->update(['status' => 3]);
                return Common::buildApiResponse(["code" => $order->od_code], _ApiCode::SUCCESS);
            }
            if ($request->type == 'template') {
                if ($order->od_status == 15) {
                    Order::ChangeStatus($order,16);
                    return Common::buildApiResponse([], _ApiCode::SUCCESS);
                }

                if ($order->od_status == 17) {
                    Order::ChangeStatus($order,18);
                    return Common::buildApiResponse([], _ApiCode::SUCCESS);
                }
                return Common::buildApiResponse([], _ApiCode::ERROR_UNKNOWN);
            }
            if ($request->type == 'transport') {
                if (in_array($order->od_status,[35,21,22,23,24,25,26])) {
                    if ($order->od_total-$order->od_paid > 0) {
                        Order::ChangeStatus($order,27);
                    } else {
                        Order::ChangeStatus($order,29);
                    }
                    return Common::buildApiResponse([], _ApiCode::SUCCESS);
                }
                return Common::buildApiResponse([], _ApiCode::ERROR_UNKNOWN);
            }
            if ($request->type == 'rate') {
                Rating::create([
                    'rate_star' => $request->star,
                    'rate_content' => $request->content,
                    'rate_targetType' => Order::class,
                    'rate_targetId' => $order->od_id,
                    'rate_authorType' => Supplier::class,
                    'rate_authorId' => $supplier->sp_id,
                ]);
                return Common::buildApiResponse([], _ApiCode::SUCCESS);
            }
            if ($request->type == 'bid') {
                $countBid = Order_detail::where('od_order', $order->od_id)
                    ->where('od_type', 8)
                    ->where('od_status', 1)
                    ->count();
                if ($countBid < 3) {
                    $priceUnit = $request->priceUnit;
                    $totalPrice = $priceUnit * $order->od_quantity;
                    if ($order->orderType['bill'] == 1) $totalPrice *= 1.1;
                    $payment2 = 0;
                    $payment3 = 0;

                    if ($order->orderType['template'] === 1) {
                        $payment1 = 1000000;
                        if ($totalPrice < 100 * 1000 * 1000) {
                            $payment2 = $totalPrice;
                        } else if ($totalPrice < 500 * 1000 * 1000) {
                            $payment2 = $totalPrice * 0.6;
                            $payment3 = $totalPrice * 0.4;
                        } else {
                            $payment2 = $totalPrice * 0.4;
                            $payment3 = $totalPrice * 0.6;
                        }
                        $this->dal_order->createOrderDetail([
                            'od_order' => $order->od_id,
                            'od_type' => 8,
                            'od_name' => 'supplier suggest',
                            'od_assigneeTo' => $supplier->sp_id,
                            'od_priceUnit' => doubleval($request->priceUnit),
                            'od_priceNow' => $totalPrice,
                            'od_price' => $totalPrice,
                            'od_priority' => 1,
                            'od_detail' => serialize([
                                'image' => $request->image,
                                'note' => $request->note,
                                'time_template' => $request->timeTemplate,
                                'price_template' => $payment1,
                                'time_finish' => $request->timeFinish,
                                'material' => $request->material,
                                'payment1' => $payment1,
                                'payment2' => $payment2,
                                'payment3' => $payment3,
                            ])
                        ]);
                    } else {
                        if ($totalPrice < 100 * 1000 * 1000) {
                            $payment1 = $totalPrice;
                        } else if ($totalPrice < 500 * 1000 * 1000) {
                            $payment1 = $totalPrice * 0.6;
                            $payment2 = $totalPrice * 0.4;
                        } else {
                            $payment1 = $totalPrice * 0.4;
                            $payment2 = $totalPrice * 0.6;
                        }
                        $this->dal_order->createOrderDetail([
                            'od_order' => $order->od_id,
                            'od_type' => 8,
                            'od_name' => 'supplier suggest',
                            'od_assigneeTo' => $supplier->sp_id,
                            'od_priceUnit' => doubleval($request->priceUnit),
                            'od_priceNow' => $totalPrice,
                            'od_price' => $totalPrice,
                            'od_priority' => 1,
                            'od_detail' => serialize([
                                'image' => $request->image,
                                'note' => $request->note,
                                'time_template' => '',
                                'price_template' => '',
                                'time_finish' => $request->timeFinish,
                                'material' => $request->material,
                                'payment1' => $payment1,
                                'payment2' => $payment2,
                                'payment3' => $payment3,
                            ])
                        ]);
                    }

                    Order_supplier::where('order_id', $order->od_id)
                        ->where('sp_id', $supplier->sp_id)
                        ->update(['status' => 2]);

                    $countBid = Order_detail::where('od_order', $order->od_id)
                        ->where('od_type', 8)
                        ->where('od_status', 1)
                        ->count();
                    if ($countBid >= 3) {
                        // other suppliers miss bid
                        $contentMail = [
                            'msTitle' => 'Bạn đã bỏ lỡ mất báo giá đơn hàng ' . $order->od_code . ' - ' . $order->product->prd_name,
                            'msMessage' => 'Bạn đã bỏ lỡ mất báo giá đơn hàng ' . $order->od_code . ' - ' . $order->product->prd_name
                                . '. Khách hàng đã chọn được xưởng báo giá phù hợp',
                            'msUrl' => _ObjectType::URL_WEB_SUPPLIER . _ObjectType::PATH_MANAGER_ORDER,
                            'msSale' => '',
                        ];
                        Order_supplier::where('order_id', $order->od_id)
                            ->where('status', 1)
                            ->update(['status' => 6]);
                        $list_supplier_id = Order_supplier::where('order_id', $order->od_id)
                            ->where('status', 6)->pluck('sp_id');
                        foreach ($list_supplier_id as $sp_id) {
                            $supplier = Supplier::find($sp_id);
                            if ($supplier && $supplier->sp_email &&
                                filter_var($supplier->sp_email, FILTER_VALIDATE_EMAIL)) {
                                dispatch(new OrderChangeFactory($contentMail, $sp_id));
                            }
                        }
                        Order::ChangeStatus($order, 11);
                    }
                    return Common::buildApiResponse([], _ApiCode::SUCCESS);
                }
                return Common::buildApiResponse([], _ApiCode::ERROR_UNKNOWN);
            }
            return Common::buildApiResponse([], _ApiCode::ERROR_UNKNOWN);
        } catch (\Exception $e) {
            activity()->performedOn(Order::getModel())
                ->causedBy(\Auth::user())
                ->withProperties(['action' => 'processOrder'])
                ->log("line " . $e->getLine() . " file " . $e->getFile() . "\n" . $e->getMessage());
            \Log::error($e->getMessage(), $e->getTrace());
            return Common::buildApiResponse([], _ApiCode::ERROR_UNKNOWN);
        }
    }

    public function postChooseSupplier($odCode, $supplierId)
    {
        try {
            $order = Order::where('od_code', $odCode)->first();
            if ($order && $order->od_id) {
                $suggest = Order_detail::where('od_order', $order->od_id)
                    ->where('od_type', 1)->where('od_assigneeTo', $supplierId)->first();
                if ($suggest) {
                    $suggestDetail = unserialize($suggest->od_detail);

                    $priceOrder = $suggest->od_priceUnit * $order->od_quantity;
                    $priceVat = 0;
                    $priceTemplate = 0;
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

                    Order::ChangeStatus($order, 13);
                    $order->save();

                    return _ApiCode::SUCCESS;
                }
            }
            return _ApiCode::ERROR_UNKNOWN;
        } catch (\Exception $e) {
            //log exception
            activity()->performedOn(Order::getModel())
                ->causedBy(\Auth::user())
                ->withProperties(['action' => 'postChooseSupplier'])
                ->log("line " . $e->getLine() . " file " . $e->getFile() . "\n" . $e->getMessage());
            \Log::error($e->getMessage(), $e->getTrace());
            return _ApiCode::ERROR_UNKNOWN;
        }
    }

    public function getReceivedOrder($odCode)
    {
        try {
            $order = Order::where('od_code', $odCode)->first();
            if ($order && $order->od_id && $order->od_status == 29) {
                Order::ChangeStatus($order, 30);

                $order->od_deliveredTime = Carbon::now();
                $order->save();

                return _ApiCode::SUCCESS;
            }
            return _ApiCode::ERROR_UNKNOWN;
        } catch (\Exception $e) {
            //log exception
            activity()->performedOn(Order::getModel())
                ->causedBy(\Auth::user())
                ->withProperties(['action' => 'getReceivedOrder'])
                ->log("line " . $e->getLine() . " file " . $e->getFile() . "\n" . $e->getMessage());
            \Log::error($e->getMessage(), $e->getTrace());
            return _ApiCode::ERROR_UNKNOWN;
        }
    }

    public function postPaymentOrder($code)
    {
        try {
            $currentOrder = Order::where('od_code', $code)->first();
            if ($currentOrder && $currentOrder->od_id) {
                if ($currentOrder->od_status == 13) {
                    Order::ChangeStatus($currentOrder, 14);
                }
                if ($currentOrder->od_status == 19) {
                    Order::ChangeStatus($currentOrder, 20);
                }
                if ($currentOrder->od_status == 27) {
                    Order::ChangeStatus($currentOrder, 28);
                }
                return _ApiCode::SUCCESS;
            }
            return _ApiCode::ERROR_UNKNOWN;
        } catch (\Exception $e) {
            //log exception
            activity()->performedOn(Order::getModel())
                ->causedBy(\Auth::user())
                ->withProperties(['action' => 'postPaymentOrder'])
                ->log("line " . $e->getLine() . " file " . $e->getFile() . "\n" . $e->getMessage());
            \Log::error($e->getMessage(), $e->getTrace());
            return _ApiCode::ERROR_UNKNOWN;
        }
    }

    public function postAddOrder($request)
    {
        $orderData = $this->dataOrderDetail($request);

        //create order
        if ($newOrder = $this->dal_order->createOrder($orderData)) {
            //upload image
            $listImageId = $request->imgId;
            if (is_array($listImageId)) $arrImageId = $listImageId;
            else $arrImageId = explode(',', $listImageId);
            foreach ($arrImageId as $imgId) {
                if ($imgId > 0) $this->dal_order->updateImageOrder($imgId, array(
                    'img_order' => $newOrder->od_id,
                ));
            }

            $newOrder->od_code = $this->genOrderCode($newOrder->od_id);
            $newOrder->save();

            Order::ChangeStatus($newOrder, $newOrder->od_status);
            return $newOrder;
        }
        return false;
    }

    public function dataOrderDetail($request)
    {
        $dt = Carbon::parse($request->deliverDate)->toDateString();
        //generate type order from bill, template, other require
        $orderType = Order::setType([
            'resource' => 0,
            'bill' => $request->bill,
            'template' => $request->sample,
            'otherRequire' => $request->otherRequire,
            'liveTemplate' => $request->liveTemplate,
        ]);

        $totalProduct = $request->totalQuantity;

        $firstStatus = Order_status::where('stt_parent', 0)
            ->orderBy('stt_order', 'asc')
            ->first('stt_id');

        $initialStatus = Order_status::where('stt_parent', $firstStatus->stt_id)
            ->orderBy('stt_order', 'asc')
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
            'od_requiredType' => implode(',', $request->require),
            'od_type' => $orderType,
            'od_message' => $request->note,
            'od_requiredDate' => $dt,
            'od_wantedPrice' => doubleval($request->wantedPrice),
            'od_createdBy' => \Auth::user()->getAuthIdentifier(),
        ];
        return $orderData;
    }

    public function genOrderCode($id)
    {
        $dateCreate = Carbon::now();
        $numSupplier = $this->dal_order->getCountByMonth($id);
        return 'DH' . $dateCreate->format('ymd') . $numSupplier;
    }

    public function postRateOrder($request)
    {
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
                    if ($supplier && $supplier->sp_id) {
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
                ->log("line " . $e->getLine() . " file " . $e->getFile() . "\n" . $e->getMessage());
            \Log::error($e->getMessage(), $e->getTrace());
            return _ApiCode::ERROR_UNKNOWN;
        }
    }

    public function getReorder($odCode)
    {
        $order = Order::where('od_code', $odCode)->first();
        if ($order && $order->od_id) {
            $newRequireDate = date("Y-m-d",
                time() + strtotime($order->od_requiredDate) - strtotime($order->created_at));
            if ($newOrder = Order::create([
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
            ])) {
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

                return Common::buildApiResponse(["code" => $odCode, 'newCode' => $newOrder->od_code], _ApiCode::SUCCESS);
            }
        }
        return Common::buildApiResponse([], _ApiCode::ERROR_UNKNOWN);
    }

    public function uploadImageOrder()
    {
        $imageInfo = getimagesize($_FILES['file']['tmp_name']);
        if ($imageInfo['mime'] == ("image/png") ||
            $imageInfo['mime'] == ("image/jpeg") ||
            $imageInfo['mime'] == ("image/gif") ||
            $imageInfo['mime'] == ("image/jpg") ||
            $imageInfo['mime'] == ("image/bmp")) {

            $file = $file = Input::file('file');
            $destination = 'order';
            $alias = $this->CommonUpload($destination, $file);
            if ($alias) {
                $this->imageCrop->MakeOrderThumb($alias);
                $imageModel = $this->dal_order->createImageOrder([
                    'img_src' => '/' . $alias,
                ]);
                return response()->json(Common::buildApiResponse([
                    "uploaded" => 1,
                    "img_id" => $imageModel->img_id,
                ]));
            } else return response()->json(
                array(
                    "uploaded" => 0,
                    "img_id" => 0
                )
            );
        }
        return response()->json(
            array(
                "uploaded" => 0,
                "img_id" => 0
            )
        );
    }

    public function getTopOrder($spId, $range)
    {
        try {
            $startDate = date_format(Carbon::now()->subMonthsNoOverflow($range - 1), "Y/m/d");
            $endDate = date_format(Carbon::now(), "Y/m/d");
            $listOrderId = Order::where('od_assigneeTo', $spId)
                ->where('od_status', '=', 33)
                ->where('updated_at', '>=', $startDate)
                ->where('updated_at', '<=', $endDate)
                ->pluck('od_id');
            $listTopOrderId = Order_detail::where('od_assigneeTo', $spId)
                ->where('od_type', 8)
                ->whereIn('od_order', $listOrderId)
                ->orderBy('od_price', 'desc')
                ->take(10)
                ->pluck('od_order');
            $topOrder = [];
            foreach ($listTopOrderId as $odId) {
                $order = Order::where('od_id', $odId)->first();
                $order->orderTotalSupplier = $order->getOrderTotalSupplier($spId);
                array_push($topOrder, $order);
            }
            return $topOrder;
        } catch (\Exception $e) {
            //log exception
            activity()->performedOn(Order::getModel())
                ->causedBy(Auth::user())
                ->withProperties(['action' => 'topOrder'])
                ->log("line " . $e->getLine() . " file " . $e->getFile() . "\n" . $e->getMessage());
            \Log::error($e->getMessage(), $e->getTrace());
            return [];
        }
    }

    public function getRevenue($spId, $range)
    {
        try {
            $dataRevenue = [];
            $totalOdByMonth = [];
            for ($i = 0; $i < $range; $i++) {
                $month = Carbon::now()->subMonthsNoOverflow($i);
                $dataRevenue[$month->englishMonth] = $this->getRevenueByMonth($spId, $month);
                $totalOdByMonth[$month->englishMonth] = $this->getTotalOrderByMonth($spId, $month);
            }
            return $data = [
                "dataRevenue" => $dataRevenue,
                "totalOdByMonth" => $totalOdByMonth,
            ];
        } catch (\Exception $e) {
            return $data = [
                "dataRevenue" => [],
                "totalOdByMonth" => [],
            ];
        }
    }

    public function getRevenueProduct($spId, $range)
    {
        try {
            $startDate = date_format(Carbon::now()->subMonthsNoOverflow($range - 1), "Y/m/d");
            $endDate = date_format(Carbon::now(), "Y/m/d");
            $revenueByProduct = [];
            $listProduct = Product::where('prd_status', DAL_Config::STATUS_ACTIVE)
                ->get();
            foreach ($listProduct as $product) {
                if ($startDate == $endDate) {
                    $listOrderIdByProduct = Order::where('od_assigneeTo', $spId)
                        ->where('od_status', '=', 33)
                        ->where('od_product', $product->prd_id)
                        ->whereMonth('updated_at', $endDate)
                        ->whereYear('updated_at', $endDate)
                        ->pluck('od_id');
                } else {
                    $listOrderIdByProduct = Order::where('od_assigneeTo', $spId)
                        ->where('od_status', '=', 33)
                        ->where('od_product', $product->prd_id)
                        ->where('updated_at', '>=', $startDate)
                        ->where('updated_at', '<=', $endDate)
                        ->pluck('od_id');
                }
                $totalPriceByProduct = Order_detail::where('od_assigneeTo', $spId)
                    ->where('od_type', 8)
                    ->whereIn('od_order', $listOrderIdByProduct)
                    ->sum('od_price');
                if ($totalPriceByProduct > 0) {
                    $revenueByProduct[$product->prd_name] = $totalPriceByProduct;
                }
            }
            return $data = [
                "revenueByProduct" => $revenueByProduct,
            ];
        } catch (\Exception $e) {
            //log exception
            \Log::error($e->getMessage(), $e->getTrace());
            return $data = [
                "revenueByProduct" => [],
            ];
        }
    }

    public function getOrderStatistic($spId, $range)
    {
        try {
            $startDate = date_format(Carbon::now()->subMonthsNoOverflow($range - 1), "Y/m/d");
            $endDate = date_format(Carbon::now(), "Y/m/d");
            return $data = [
                "dataOrder" => [
                    'totalOdCurrentMonth' => $this->getTotalOrderByState(
                        $spId, 'finish', $endDate, $endDate),
                    'totalOdConnect' => $this->getTotalOrderByState(
                        $spId, 'all', $startDate, $endDate),
                    'totalOdBidding' => $this->getTotalOrderByState(
                        $spId, 'bidding', $startDate, $endDate),
                    'totalOdProduce' => $this->getTotalOrderByState(
                        $spId, 'produce', $startDate, $endDate),
                    'totalOdBid' => $this->getTotalOrderByState($spId, 'bid'),
                    'totalOdTransport' => $this->getTotalOrderByState($spId, 'transport'),
                    'totalOdRate' => $this->getTotalOrderByState($spId, 'rate'),
                    'totalOdFinish' => $this->getTotalOrder($spId),
                ]
            ];
        } catch (\Exception $e) {
            //log exception
            \Log::error($e->getMessage(), $e->getTrace());
            return $data = [
                "dataOrder" => []
            ];
        }
    }

    public function getRevenueByMonth($spId ,$date)
    {
        $listOdId = Order::where('od_assigneeTo', $spId)
            ->where('od_status', '=', 33)
            ->whereMonth('updated_at', $date)
            ->whereYear('updated_at', $date)
            ->pluck('od_id');
        return Order_detail::where('od_assigneeTo', $spId)
            ->where('od_type', 8)
            ->whereIn('od_order', $listOdId)
            ->sum('od_price');
    }

    public function getRevenueByProduct($spId, $startDate, $endDate)
    {
        $data = [];
        $listProduct = Product::where('prd_status', DAL_Config::STATUS_ACTIVE)
            ->get();
        foreach ($listProduct as $product) {
            $listOrderIdByProduct = Order::where('od_assigneeTo', $spId)
                ->where('od_status', '=', 33)
                ->where('od_product', $product->prd_id)
                ->where('updated_at', '>=', $startDate)
                ->where('updated_at', '<=', $endDate)
                ->pluck('od_id');
            $totalPriceByProduct = Order_detail::where('od_assigneeTo', $spId)
                ->where('od_type', 8)
                ->whereIn('od_order', $listOrderIdByProduct)
                ->sum('od_price');
            if ($totalPriceByProduct > 0) {
                $data[$product->prd_name] = $totalPriceByProduct;
            }
        }
        return $data;
    }

    public function getTotalOrderByMonth($spId, $date)
    {
        return Order::where('od_assigneeTo', $spId)
            ->where('od_status', '=', 33)
            ->whereMonth('updated_at', $date)
            ->whereYear('updated_at', $date)
            ->count();
    }

    public function getTotalOrder($spId)
    {
        return Order::where('od_assigneeTo', $spId)
            ->where('od_status', '=', 33)
            ->count();
    }

    public function getTotalOrderByState($spId, $state, $startDate = '', $endDate = '')
    {
        $lstStatus = [];
        $bid = [];
        if ($state == 'all') {
            $lstStatus = range(3, 36);
            $bid = range(1,6);
        } elseif ($state == 'bid') {
            $lstStatus = [];
            $bid = [1];
        } elseif ($state == 'bidding') {
            $lstStatus = [];
            $bid = [2,4,5];
        }
        elseif ($state == 'produce') $lstStatus = range(21, 33);
        elseif ($state == 'transport') $lstStatus = range(29, 32);
        elseif ($state == 'finish' || $state == 'rate') $lstStatus = [33];
        $lstBid = Order_supplier::where('sp_id', $spId)->whereIn('status', $bid)
            ->pluck('order_id');

        if ($state == 'bid' || $state == 'transport') {
            $totalOrder = Order::whereIn('od_id', $lstBid)
                ->orWhere(function ($query) use ($spId, $lstStatus) {
                    $query->where('od_assigneeTo', $spId)
                        ->whereIn('od_status', $lstStatus);
                })
                ->count();
            return $totalOrder;
        }

        if ($state == 'rate') {
            $listOrder = Order::where('od_assigneeTo', $spId)
                ->whereIn('od_status', $lstStatus)
                ->get();
            $listRateOdId = [];
            foreach ($listOrder as $order) {
                if(!$this->dal_order->checkSupplierRateOrder($order->od_id)){
                    array_push($listRateOdId, $order->od_id);
                };
            }
            $totalOrder = Order::whereIn('od_id', $listRateOdId)->count();
            return $totalOrder;
        }

        if ($state == 'finish') {
            $totalOrder = Order::whereIn('od_id', $lstBid)
                ->orWhere(function ($query) use ($spId, $lstStatus) {
                    $query->where('od_assigneeTo', $spId)
                        ->whereIn('od_status', $lstStatus);
                })
                ->whereMonth('updated_at', $endDate)
                ->whereYear('updated_at', $endDate)
                ->count();
            return $totalOrder;
        }

        $totalOrder = Order::whereIn('od_id', $lstBid)
            ->orWhere(function ($query) use ($spId, $lstStatus) {
                $query->where('od_assigneeTo', $spId)
                    ->whereIn('od_status', $lstStatus);
            })
            ->where('updated_at', '>=', $startDate)
            ->where('updated_at', '<=', $endDate)
            ->count();
        return $totalOrder;
    }
}