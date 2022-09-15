<?php
/**
 * Created by PhpStorm.
 * User: QuanVH
 * Date: 17/02/2017
 * Time: 21:54 CH
 */

namespace App\Http\Business\Frontend;

use App\Models\Order;
use App\Models\Rating;

class BzSupplier extends BzFrontend
{
    public function getListRate($spId){
        $supplier = $this->dal_supplier->getDetailSupplier($spId);
        $lstOrder = Order::where('od_assigneeTo',$spId)->pluck('od_id');
        $lstRate = Rating::where('rate_targetType',Order::class)
            ->whereIn('rate_targetId',$lstOrder)->get();
        return [
            'supplier' => $supplier,
            'rate' => $lstRate
        ];
    }
}