<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Ramsey\Uuid\Uuid;


class ApiController extends Controller
{
    /**
     * @param $productId
     */
    public function generateSKU($productId){
        // example NF12G318SG
        // two character for trademark
        // two number for type product
        // three character for cate product
        // two character for branch
    }

    public function generateUniqueCode(){
        return Uuid::uuid4();
    }
}
