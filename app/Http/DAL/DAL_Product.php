<?php
/**
 * Created by PhpStorm.
 * User: QuanVH
 * Date: 17/02/2017
 * Time: 21:45 CH
 */

namespace App\Http\DAL;

use App\Models\Product;
use App\Models\Cate_product;
use App\Models\Product_image;

class DAL_Product
{
    protected $sumField;
    protected $productStatus = [
        DAL_Config::PRODUCT_STATUS_PUBLIC
    ];

    public function __construct(){
        $this->sumField = [
            'prd_id','prd_promote', 'prd_priceNow',
            'prd_name','prd_alias','prd_createdBy',
            'prd_cate', 'prd_status', 'prd_price',
            'created_at'
        ];
    }

    #region *** PRODUCT ***
    public function getListProduct($status, $order = 'created_at',$desc = 'desc',$num = 3*DAL_Config::NUM_PER_PAGE_PRODUCT){
        return Product::whereIn('prd_status',$status)
            ->orderBy($order, $desc)
            ->select($this->sumField)
            ->with(['cate_product','author','image'])
            ->paginate($num);
    }

    public function getListTreeProduct(){
        return Cate_product::where('cate_status','!=',DAL_Config::STATUS_DELETED)
            ->orderBy('cate_order','asc')->with('product')->get();
    }

    public function getListProductFeature(){
        return Product::where('prd_status',[DAL_Config::PRODUCT_STATUS_PUBLIC])
            ->where('prd_promote','>',0)
            ->groupBy('prd_promote')
            ->orderBy('prd_promote', 'asc')
            ->with(['image'])
            ->take(3)->get();
    }

    public function getListPublicProduct(){
        return Product::where('prd_status', DAL_Config::PRODUCT_STATUS_PUBLIC)
            ->orderBy('created_at', 'desc')
            ->get(['prd_id', 'prd_name']);
    }

    public function getListProductPublic(){
        return $this->getListProduct([DAL_Config::PRODUCT_STATUS_PUBLIC]);
    }

    public function getListProductByCate($lstCate,$num = 3*DAL_Config::NUM_PER_PAGE_PRODUCT){
        return Product::whereIn('prd_status',$this->productStatus)
            ->whereIn('prd_cate',$lstCate)
            ->orderBy('created_at', 'desc')
            ->whereIn('prd_status',[DAL_Config::PRODUCT_STATUS_PUBLIC])
            ->paginate($num);
    }

    public function getDetailProduct($prdId){
        return Product::where('prd_id',$prdId)->with(['cate_product','author','image'])->first();
    }

    public function createProduct($data = array()){
        return Product::create($data);
    }

    public function updateProduct($prdId = 1, $data = array()){
        return Product::where('prd_id',$prdId)->update($data);
    }
    #endregion


    #region *** CATE PRODUCT ***
    public function getListCateProduct($status){
        return Cate_product::whereIn('cate_status',$status)->get();
    }

    public function getListCatePublic(){
        return $this->getListCateProduct([1]);
    }

    public function getListCateAjax($order,$direct,$num){
        return Cate_product::whereIn('cate_status',[1])
            ->orderBy($order,$direct)->paginate($num);
    }

    public function getDetailCateProduct($cate){
        return Cate_product::where('cate_id',$cate)->orWhere('cate_alias',$cate)->first();
    }

    public function createCateProduct($array){
        return Cate_product::create($array);
    }

    public function updateCateProduct($cateId = 1, $data = array()){
        return Cate_product::where('cate_id', $cateId)
            ->update($data);
    }
    #endregion


    #region *** IMAGE PRODUCT ***
    public function getImageProduct($imgId) {
        return Product_image::where('img_id', $imgId)->first();
    }

    public function createImageProduct($array){
        return Product_image::create($array);
    }

    public function updateImageProduct($imgId, $data){
        return Product_image::where('img_id',$imgId)->update($data);
    }

    public function deleteImageProduct($imgId){
        return Product_image::where('img_id',$imgId)->delete();
    }
    #endregion
}