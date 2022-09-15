<?php
/**
 * Created by PhpStorm.
 * User: QuanVH
 * Date: 17/02/2017
 * Time: 21:45 CH
 */

namespace App\Http\DAL;


use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Order_image;
use App\Models\Order_status;
use App\Models\Order_supplier;
use App\Models\Rating;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DAL_Order
{
    public function createOrder($array){
        return Order::create($array);
    }

    public function getListOrder($num = DAL_Config::NUM_PER_PAGE_ORDER){
        return Order::orderBy('created_at', 'desc')
            ->whereNotIn('od_status',[DAL_Config::STATUS_DELETED])
            ->paginate($num);
    }

    public function getListOrderByUser($userId){
        return Order::orderBy('created_at', 'desc')
            ->where('od_createdBy',$userId)
            ->whereNotIn('od_status',[DAL_Config::STATUS_DELETED])
            ->get();
    }

    public function getListOrderSupplier(){
        return Order::where('od_supplier',Auth::user()->user_id)
            ->whereNotIn('od_status',[DAL_Config::STATUS_DELETED])
            ->get();
    }

    public function getDetailOrder($odId){
        return Order::where('od_id',$odId)
            ->with('suggest','size','image','latestNote')->first();
    }

    public function getListPaymentOrder($odId){
        return Order_detail::where('od_order',$odId)
            ->where('od_type',5)->orderBy('created_at','asc')->get();
    }

    public function getListChangeStatus($odId){
        $lstStatus = Order_status::groupBy('stt_parent')
            ->whereNotIn('stt_parent',[0,8])->pluck('stt_id');
        $lstOrderDetail = Order_detail::where('od_order',$odId)
            ->where('od_type',4)
            ->whereIn('od_assigneeTo',$lstStatus)
            ->orderBy('created_at','asc')->get(['od_id','od_order','created_at','od_assigneeTo']);
        foreach ($lstOrderDetail as $detail){
            $orderStatus = Order_status::where('stt_id',$detail->od_assigneeTo)->first();
            if ($orderStatus && $orderStatus->stt_id) {
                $detail->stage = $orderStatus->stt_parent;
            }
            else $detail->stage = 0;
        }
        return $lstOrderDetail;
    }

    public function getListChangeStatusSupplier($odId, $spId){
        $lstStatus = Order_status::groupBy('stt_parent')
            ->whereIn('stt_parent', [2,4,6,7])->pluck('stt_id')->toArray();
        array_push($lstStatus, 35);

        $lstOrderDetail = Order_detail::where('od_order', $odId)
            ->where('od_type', 4)
            ->whereIn('od_assigneeTo', $lstStatus)
            ->orWhere(function ($query) use ($odId, $spId) {
                $query->where('od_order', $odId)
                    ->where('od_type', 8)
                    ->where('od_assigneeTo', $spId);
            })
            ->orderBy('created_at','asc')
            ->get(['od_id','od_order','created_at','od_assigneeTo']);;
        foreach ($lstOrderDetail as $detail){
            $orderStatus = Order_status::where('stt_id',$detail->od_assigneeTo)->first();
            if ($orderStatus && $orderStatus->stt_id) {
                $detail->stage = $orderStatus->stt_parent;
            }
            else $detail->stage = 0;
        }
        return $lstOrderDetail;
    }

    public function updateOrder($odId, $array){
        return Order::where('od_id',$odId)->update($array);
    }

    public function getCountByMonth($id){
        return Order::whereMonth('created_at',Carbon::now()->month)
            ->whereYear('created_at',Carbon::now()->year)
            ->where('od_id','<=',$id)->count();
    }

    public function getImageOrder($imgId) {
        return Order_image::where('img_id', $imgId)->first();
    }

    public function createImageOrder($array){
        return Order_image::create($array);
    }

    public function updateImageOrder($imgId, $data){
        return Order_image::where('img_id',$imgId)->update($data);
    }

    public function getDetailImage($imgId){
        return Order_image::find($imgId);
    }

    public function deleteImageOrder($imgId){
        return Order_image::where('img_id',$imgId)->delete();
    }

    public function deleteOrderImage($odId){
        return Order_image::where('img_order',$odId)->delete();
    }

    public function deleteOrderDetail($odId){
        return Order_detail::where('od_order',$odId)->delete();
    }

    public function deleteOrderDetailSuggest($odId, $type = 1) {
        return Order_detail::where('od_type',$type)
            ->where('od_order',$odId)->delete();
    }

    public function deleteOrderDetailSize($odId) {
        return Order_detail::where('od_type',2)
            ->where('od_order',$odId)->delete();
    }

    public function createOrderDetail($array){
        $count = count(Order_detail::where('od_order',$array['od_order'])->get());
        $array['od_id'] = $array['od_order'].'DT'.($count+1);
        return Order_detail::create($array);
    }

    public function checkUserRateOrder($odId){
        $rating = Rating::where('rate_targetId',$odId)
            ->where('rate_authorType',User::class)
            ->where('rate_targetType',Order::class)
            ->where('rate_authorId',\Auth::user()->user_id)->first();
        if ($rating && $rating->rate_id) return true;
        return false;
    }

    public function checkSupplierRateOrder($odId){
        $supplier = Supplier::where('sp_manager', Auth::user()->user_id)->first();
        $rating = Rating::where('rate_targetId',$odId)
            ->where('rate_authorType',Supplier::class)
            ->where('rate_targetType',Order::class)
            ->where('rate_authorId',$supplier->sp_id)->first();
        if ($rating && $rating->rate_id) return true;
        return false;
    }

    public function getChangeSttOrder($odId,$sttId){
        return Order_detail::where('od_order',$odId)
            ->where('od_type',4)->where('od_assigneeTo',$sttId)
            ->first();
    }

    public function getListOrderStatusShow(){
        $lstStatus = Order_status::where('stt_parent',0)->whereNotIn('stt_id',[8])
            ->orderBy('stt_order','asc')
            ->get();
        return $lstStatus;
    }

    public function getListChangeStt($odId){
        return Order_detail::where('od_type',4)
            ->where('od_order',$odId)
            ->orderBy('created_at','asc')->get();
    }

    public function getListSuggestByOrder($odId){
        $currentOrder = Order::find($odId);
        if ($currentOrder && $currentOrder->od_id) {
            $lstOrder = Order::where('od_product', $currentOrder->od_product)
                ->where('od_id','!=',$odId)->with('suggest_uMake')->get();
            return $lstOrder;
        }
    }

    public function getNoteByOrder($odId){
            return Order_detail::where('od_order', $odId)
                ->where('od_type',3)
                ->orderBy('created_at','asc')->with('assignee')->get();
    }

    public function cancelOrder($odId) {
        return Order_supplier::where('order_id', $odId)
            ->whereIn('status', [1,2])
            ->update([
                'status' => 3,
            ]);
    }
}