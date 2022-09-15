<?php
/**
 * Created by PhpStorm.
 * Project: Alium_main
 * User: quanvu
 * Date: 13/07/2019
 */


namespace App\Http\Business\API;


use App\Http\DAL\DAL_Config;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Support\Facades\App;

class BzProduct extends BzApi
{

    public function getListProductFeature(){
        App::setLocale('vi');
        return $this->dal_product->getListPublicProduct();
    }

    public function getListProductPublic(){
//        App::setLocale('vi');
        return $this->dal_product->getListTreeProduct();
    }
}
