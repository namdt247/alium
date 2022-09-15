<?php
/**
 * Created by PhpStorm.
 * User: QuanVH
 * Date: 17/02/2017
 * Time: 21:45 CH
 */

namespace App\Http\Controllers\Api;


use App\Helper\Common;
use App\Http\Business\API\BzOrder;
use App\Http\Business\API\BzProduct;
use App\Http\Business\API\BzSupplier;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $bzProduct;
    protected $bzSupplier;

    public function __construct()
    {
        parent::__construct();
        $this->bzProduct = new BzProduct();
        $this->bzSupplier = new BzSupplier();
    }

    public function index(){
        return response()->json(Common::buildApiResponse([
            'feature' => $this->bzProduct->getListProductFeature(),
            'product' => $this->bzProduct->getListProductPublic(),
        ]));
    }

    public function postAddProduct(Request $request){
        return response()->json(Common::buildApiResponse([], $this->bzSupplier->postAddProduct($request)));
    }
}