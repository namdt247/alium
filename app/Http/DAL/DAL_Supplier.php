<?php
/**
 * Created by PhpStorm.
 * User: QuanVH
 * Date: 17/02/2017
 * Time: 21:45 CH
 */

namespace App\Http\DAL;


use App\Helper\_ObjectType;
use App\Models\Supplier;
use App\Models\Supplier_detail;
use Carbon\Carbon;

class DAL_Supplier
{
    public function createSupplier($array){
        return Supplier::create($array);
    }

    public function getListSupplier($status, $order = 'created_at',$desc = 'desc',$num = DAL_Config::NUM_PER_PAGE_USER){
        return Supplier::whereIn('sp_status',$status)
            ->orderBy($order, $desc)
            ->paginate($num);
    }

    public function getCountByMonth($id){
        return Supplier::whereMonth('created_at',Carbon::now()->month)
            ->whereYear('created_at',Carbon::now()->year)
            ->where('sp_id','<=',$id)->count();
    }

    public function getDetailSupplier($spId){
        return Supplier::find($spId);
    }

    public function getDefaultSupplierInfo($key){
        $retVal = [];
        switch ($key){
            case _ObjectType::KEY_GENERAL_INFO:
                $retVal = [
                    "logo" => "",
                    "companyName" => "",
                    "globalName" => "",
                    "businessCode" => "",
                    "businessImage" => "",
                    "email" => "",
                    "website" => "",
                    "address" => "",
                    "city" => "",
                    "startYear" => "",
                    "numEmployee" => "",
                    "factoryAddress" => [],
                    "promotionText" => "",
                    "typeOfProduct" => "",
                    "typeOfBusiness" => "",
                    "market" => "",
                    "marketName" => [],
                    "historyBrand" => [],
                ];
                break;
            case _ObjectType::KEY_BUSINESS_OWNER:
                $retVal = [
                    "fullName" => "",
                    "phone" => "",
                    "email" => "",
                    "address" => "",
                    "image" => [],
                ];
                break;
            case _ObjectType::KEY_ORDER_PROCESS:
                $retVal = [
                    "position" => "",
                    "fullName" => "",
                    "phone" => "",
                    "email" => "",
                    "address" => "",
                    "image" => [],
                ];
                break;
            case _ObjectType::KEY_SERVICE:
                $retVal = [
                    "logistic" => "",
                    "deliver" => "",
                    "deliverPartner" => [],
                    "otherService" => [],
                    "produceService" => [],
                ];
                break;
            case _ObjectType::KEY_ADVANCE_INFO:
                $retVal = [
                    "certificate" => [],
                    "otherCertificate" => [],
                    "factoryImage" => [],
                    "profile" => "",
                ];
                break;
            default: break;
        }
        return $retVal;
    }

    public function getSupplierInfo($sId, $keyName){
        $siteInfo =  Supplier_detail::where('sp_supplier',$sId)->where('sp_name',$keyName)->first();
        if ($siteInfo && $siteInfo->sp_supplier){
            return $siteInfo->sp_detail;
        }
        return $this->getDefaultSupplierInfo($sId);
    }

    public function setSupplierInfo($sId, $keyName, $value){
        $siteInfo =  Supplier_detail::where('sp_supplier',$sId)->where('sp_name',$keyName)->first();
        if ($siteInfo && $siteInfo->sp_supplier){
            return Supplier_detail::where('sp_supplier',$sId)->where('sp_name',$keyName)
                ->update(['sp_detail'=>json_encode($value)]);
        }
        else {
            return Supplier_detail::create([
                'sp_supplier' => $sId,
                'sp_name' => $keyName,
                'sp_detail' => $value
            ]);
        }
    }
}