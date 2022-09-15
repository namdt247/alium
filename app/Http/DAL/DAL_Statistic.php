<?php
/**
 * Created by PhpStorm.
 * User: QuanVH
 * Date: 17/02/2017
 * Time: 21:45 CH
 */

namespace App\Http\DAL;


use App\Models\Order;
use Carbon\Carbon;

class DAL_Statistic
{
    public function countOrder(){
        return Order::whereMonth('created_at',Carbon::now()->month)
            ->whereYear('created_at',Carbon::now()->year)
            ->whereNotIn('od_status',[101,-1])->count('od_id');
    }

    public function countOrderCancel(){
        return Order::whereMonth('created_at',Carbon::now()->month)
            ->whereYear('created_at',Carbon::now()->year)
            ->where('od_status',34)->count('od_id');
    }

    public function countUser(){
        return Order::groupBy('od_createdBy','od_id')
            ->whereMonth('created_at',Carbon::now()->month)
            ->whereYear('created_at',Carbon::now()->year)
            ->whereNotIn('od_status',[101,-1])
            ->count('od_id');
    }
    public function countTotalRevenue(){
        return Order::whereMonth('created_at',Carbon::now()->month)
            ->whereYear('created_at',Carbon::now()->year)
            ->whereNotIn('od_status',[101,-1])->sum('od_wantedPrice');
    }
}