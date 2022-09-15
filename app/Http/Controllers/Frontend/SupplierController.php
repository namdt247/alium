<?php
/**
 * Created by PhpStorm.
 * User: QuanVH
 * Date: 17/02/2017
 * Time: 21:45 CH
 */

namespace App\Http\Controllers\Frontend;


use App\Helper\Common;
use App\Http\Business\Frontend\BzSupplier;
use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
    protected $bzSupplier;
    public function __construct()
    {
        $this->bzSupplier = new BzSupplier();
        parent::__construct();
    }

    public function getListRate($spId){
        return Common::buildApiResponse($this->bzSupplier->getListRate($spId));
    }



}