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
use App\Http\Business\Frontend\BzOrder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    protected $bzOrder;
    public function __construct()
    {
        parent::__construct();
        $this->bzOrder = new BzOrder();
    }

    public function getAddOrder(){
        return view('frontend.create_order');
    }

    public function postAddOrder(Request $request){
        $order = $this->bzOrder->postAddOrder($request);
        if ($order && $order->od_id){
            return view('frontend.create_order_success',compact('order'));
        }
    }

    public function getListOrder(){
        $data = $this->bzOrder->getListOrder();
        return view('frontend.list_order',compact('data'));
    }

    public function getHistoryOrder(){
        $data = $this->bzOrder->getHistoryOrder();
        return view('frontend.list_order',compact('data'));
    }

    public function getDetailOrder($odCode){
        $data = $this->bzOrder->getDetailOrder($odCode);
        if ($data) return view('frontend.detail_order',compact('data'));
        return redirect()->route('frontend.home');
    }

    public function getCancelOrder($odCode){
        return response()->json(Common::buildApiResponse([],$this->bzOrder->getCancelOrder($odCode)));
    }

    public function postChooseSupplier(Request $request){
        return response()->json(Common::buildApiResponse([],$this->bzOrder->postChooseSupplier($request)));
    }

    public function getPaymentOrder($code){
        $data = $this->bzOrder->getDetailOrder($code);
        return view('frontend.payment_order',compact('data'));
    }
    public function postPaymentOrder($code){
        return response()->json(Common::buildApiResponse([],$this->bzOrder->postPaymentOrder($code)));
    }

    public function getReceivedOrder($odCode){
        $errorCode = $this->bzOrder->getReceivedOrder($odCode);
        if ($errorCode == _ApiCode::SUCCESS) return redirect()->back();
    }

    public function getReorder($odCode){
        return response()->json(Common::buildApiResponse([],$this->bzOrder->getReorder($odCode)));
    }

    public function postRateOrder(Request $request){
        return response()->json(Common::buildApiResponse([],$this->bzOrder->postRateOrder($request)));
    }

}