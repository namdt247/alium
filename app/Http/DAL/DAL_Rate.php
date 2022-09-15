<?php
/**
 * Created by PhpStorm.
 * User: QuanVH
 * Date: 17/02/2017
 * Time: 21:45 CH
 */

namespace App\Http\DAL;


use App\Models\Order;
use App\Models\Rating;
use App\Models\User;

class DAL_Rate
{
    public function createOrderRate($data){
        Rating::create(array_merge($data,[
            'rate_targetType' => Order::class,
            'rate_authorType' => User::class,
        ]));
    }

    public function getDetailRate($rateId){
        return Rating::find($rateId);
    }

    public function getListRateFeature(){
        return Rating::where('rate_targetType',Order::class)
            ->where('rate_status',2)
            ->where('rate_star',5)->orderBy('created_at','desc')
            ->take(6)->get();
    }

    public function getFirstOrder(){
        return Order::orderBy('created_at', 'asc')->first();
    }

}