<?php
/**
 * Created by PhpStorm.
 * User: QuanVH
 * Date: 17/02/2017
 * Time: 21:45 CH
 */

namespace App\Http\Controllers\Api;


use App\Helper\_ApiCode;
use App\Helper\_ApiMessage;
use App\Helper\Common;
use App\Http\Business\API\BzOrder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    protected $bzOrder;

    public function __construct()
    {
        parent::__construct();
        $this->bzOrder = new BzOrder();
    }

    public function index(){
        $state = 'all';
        if (isset($_GET['state'])) $state = $_GET['state'];
        return response()->json(Common::buildApiResponse([
            'state' => $state,
            'order' => $this->bzOrder->getListOrderByUser(Auth::user()->user_id,$state),
        ],_ApiCode::SUCCESS,_ApiMessage::SUCCESS));
    }

    public function show($odCode){
        $order = $this->bzOrder->getDetailOrder($odCode);
        return response()->json(Common::buildApiResponse([
            'order' => $order,
            'status' => $this->bzOrder->getListStatus()
        ],_ApiCode::SUCCESS,_ApiMessage::SUCCESS));
    }

    public function update($odCode, Request $request){
        $type = $request->type;
        if ($type == 'cancel'){
            return response()->json($this->bzOrder->getCancelOrder($odCode));
        }elseif ($type == 'payment'){
            return response()->json(Common::buildApiResponse([],$this->bzOrder->postPaymentOrder($odCode)));
        }elseif ($type == 'chooseFactory'){
            return response()->json(Common::buildApiResponse([],
                $this->bzOrder->postChooseSupplier($odCode, $request->supplier)));
        }
        elseif ($type == 'delivery'){
            return response()->json(Common::buildApiResponse([],$this->bzOrder->getReceivedOrder($odCode)));
        }
        return response()->json(Common::buildApiResponse([],_ApiCode::ERROR_UNKNOWN));
    }

    public function store(Request $request){
        return response()->json(Common::buildApiResponse($this->bzOrder->postAddOrder($request)));
    }

    public function postRateOrder(Request $request){
        return response()->json(Common::buildApiResponse([],$this->bzOrder->postRateOrder($request)));
    }

    public function getReorder($odCode){
        return response()->json($this->bzOrder->getReorder($odCode));
    }

    public function uploadImageOrder(){
        return $this->bzOrder->uploadImageOrder();
    }

}