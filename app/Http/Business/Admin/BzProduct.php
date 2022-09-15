<?php
/**
 * Created by PhpStorm.
 * User: QuanVH
 * Date: 26/10/2016
 * Time: 21:49 CH
 */

namespace App\Http\Business\Admin;


use App\Helper\_ApiCode;
use App\Helper\Common;
use App\Http\DAL\DAL_Config;
use App\Models\Cate_product;
use App\Models\Product;
use App\Models\Taggable;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use TomLingham\Searchy\Facades\Searchy;

class BzProduct extends BzAdmin
{
    #region *** PRODUCT ***
    public function getListProductData(){
        $columns = array(
            0 => 'prd_id',
            1 => 'prd_id',
            2 => 'prd_name',
            3 => 'prd_id'
        );
        $number = $_GET['length'];
        $start = $_GET['start'];
        $search = $_GET['search']['value'];
        $page = round($start/$number)+1;
        Common::SetCurrentPage($page);
        if($search != ''){
            $lstUser = Searchy::search('product')->fields('prd_name')
                ->query($search)->getQuery()->where('prd_cate',1)->get();

            return [
                'data' => $lstUser,
                'total' => 10
            ];

        }
        else{
            return $this->dal_product->getListProductPublic();
        }
    }

    public function getListProductSearch(){
        $result = array();
        if(isset($_GET['q'])) {
            $search = trim(mb_strtolower($_GET['q']));
            $lstProduct = Searchy::search('product')->fields('prd_name')->query($search)
                ->getQuery()
                ->join('cate_product', 'product.prd_cate', '=', 'cate_product.cate_id')
                ->get();

        }
        else
            $lstProduct = Product::join('cate_product', 'product.prd_cate', '=', 'cate_product.cate_id')->get();
        foreach ($lstProduct as $product){
            array_push($result,['id'=>$product->prd_id,'text'=>$product->prd_name. ' - ' .$product->cate_value ]);
        }
        return $result;
    }


    public function getEditProduct($atcId){
        return $this->dal_product->getDetailProduct($atcId);
    }

    public function postEditProduct($request){
        try {
            $locale = App::getLocale();
            $prdId = $request->lbId;
            $product = $this->dal_product->getDetailProduct($prdId);
//            $product->prd_cate = $request->sltCate;
//            $product->prd_price = $request->txtPrice;
            $product->translate($locale)->prd_name = $request->txtTitle;
//            $product->translate($locale)->prd_sapo = $request->txtSapo;
//            $product->translate($locale)->prd_des = $request->txtContent;
//            $product->translate($locale)->prd_spec = $request->txtSpec;
            if (isset($request->txtAlias) && $request->txtAlias != '')
                $product->translate($locale)->prd_alias = trim($request->txtAlias);
            else $product->translate($locale)->prd_alias = Common::CreateSlug($request->txtTitle);

            $product->prd_promote = $request->featureProduct;

            $file = Input::file('imgFeature');
            if ($file) {
                $this->imageCrop->RemoveThumb($product->prd_featureImg);
                $alias = $this->CommonUpload(DAL_Config::IMAGE_ALIAS_PRODUCT . '/feature', $file);
                if ($alias) {
                    $this->imageCrop->MakeProductThumb($alias);
                    $product->prd_featureImg = $alias;
                }
            }

            if ($product->save()) {
//                Taggable::retag($product, $request->sltTag);
//                update image product
                $listImageId = $request->imgId;
                $arrImageId = explode(',', $listImageId);
                foreach ($arrImageId as $imgId) {
                    if ($imgId > 0) $this->dal_product->updateImageProduct($imgId, array(
                        'img_product' => $product->prd_id,
                        'img_name' => $product->prd_name . ' ' . $imgId,
                        'img_alias' => Common::CreateSlug($product->prd_name . ' ' . $imgId)
                    ));
                }
                return _ApiCode::SUCCESS;
            }
            return _ApiCode::ERROR_UNKNOWN;
        } catch (\Exception $e) {
            //log exception
            activity()->performedOn(Product::getModel())
                ->causedBy(Auth::user())
                ->withProperties(['action' => 'postEditProduct'])
                ->log("line ".$e->getLine()." file ".$e->getFile() ."\n".$e->getMessage());
            \Log::error($e->getMessage(),$e->getTrace());
            return _ApiCode::ERROR_UNKNOWN;
        }
    }

    public function postAddProduct($request){
        try {
            $array = [
                'prd_name' => $request->txtTitle,
                'prd_sapo' => $request->txtSapo,
                'prd_des' => $request->txtContent,
                'prd_spec' => $request->txtSpec,
                'prd_cate' => $request->sltCate,
                'prd_price' => $request->txtPrice,
                'prd_createdBy' => Auth::user()->user_id,
                'prd_status' => DAL_Config::PRODUCT_STATUS_PUBLIC,
                'prd_tag' => '',
                'prd_promote' => $request->featureProduct
            ];
            if (isset($request->txtAlias) && $request->txtAlias != '')
                $array['prd_alias'] = trim($request->txtAlias);
            else $array['prd_alias'] = Common::CreateSlug($request->txtTitle);

            $file = Input::file('imgFeature');
            if ($file) {
                $alias = $this->CommonUpload(DAL_Config::IMAGE_ALIAS_PRODUCT . '/feature', $file);
                if ($alias) {
                    $this->imageCrop->MakeProductThumb($alias);
                    $array['prd_featureImg'] = $alias;
                }
            }
            if ($product = $this->dal_product->createProduct($array)) {
                //tag product
//                Taggable::retag($product, $request->sltTag);

                //update list image product
                $listImageId = $request->imgId;
                $arrImageId = explode(',', $listImageId);
                foreach ($arrImageId as $imgId) {
                    if ($imgId > 0) $this->dal_product->updateImageProduct($imgId, array(
                        'img_product' => $product->prd_id,
                        'img_name' => $product->prd_name . ' ' . $imgId,
                        'img_alias' => Common::CreateSlug($product->prd_name . ' ' . $imgId)
                    ));
                }
                return _ApiCode::SUCCESS;
            }
            return _ApiCode::ERROR_UNKNOWN;
        } catch (\Exception $e) {
            //log exception
            activity()->performedOn(Product::getModel())
                ->causedBy(Auth::user())
                ->withProperties(['action' => 'postAddProduct'])
                ->log("line ".$e->getLine()." file ".$e->getFile() ."\n".$e->getMessage());
            \Log::error($e->getMessage(),$e->getTrace());
            return _ApiCode::SUCCESS;
        }
    }

    public function getDeleteProduct($prdId){
        if($this->dal_product->updateProduct($prdId,[
            'prd_status' => DAL_Config::STATUS_DELETED
        ])) return _ApiCode::SUCCESS;
        return _ApiCode::ERROR_UNKNOWN;
    }

    public function uploadImageProduct($request){
        $imageInfo = getimagesize( $_FILES['file']['tmp_name'] );
        if ( $imageInfo['mime'] == ( "image/png" ) ||
            $imageInfo['mime'] == ( "image/jpeg" ) ||
            $imageInfo['mime'] == ( "image/gif" ) ||
            $imageInfo['mime'] == ( "image/jpg" ) ||
            $imageInfo['mime'] == ( "image/bmp" ) ) {

            $file = $file = Input::file('file');
            $destination = 'product';
            $alias = $this->CommonUpload($destination, $file);
            $this->imageCrop->MakeProductMetaThumb($alias);
            if($alias){
                $imageModel = $this->dal_product->createImageProduct([
                    'img_src' => '/'.$alias,
                ]);
                return response()->json(
                    array(
                        "uploaded" => 1,
                        "img_id" => $imageModel->img_id,
                    )
                );
            }
            else{
                return response()->json(
                    array(
                        "uploaded" => 0,
                        "img_id" => 0
                    )
                );
            }
        }
    }

    public function deleteImageProduct($imgId){
        $imageModel = $this->dal_product->getImageProduct($imgId);
        if ($imageModel && $imageModel->img_id) {
            $this->imageCrop->RemoveThumb($imageModel->img_src);
            $this->dal_product->deleteImageProduct($imgId);
            return 200;
        }
        return -1;
    }
    #endregion


    #region *** CATE PRODUCT ***
    /*
     * Get list cate product
     * function getListCate
     */
    public function getListCate(){
        return $this->dal_product->getListCateProduct(1);
    }

    /*
     * Get list cate product data
     * get data to datatable
     * function getListCateAjax
     */
    public function getListCateAjax(){
        $columns = array(
            0 => 'cate_id',
            1 => 'cate_name',
            2 => 'cate_alias',
            3 => 'cate_id',
        );
        $order = $columns[$_GET['order'][0]['column']];
        $direct = $_GET['order'][0]['dir'];
        $number = $_GET['length'];
        $start = $_GET['start'];
        $page = round($start/$number)+1;

        Common::SetCurrentPage($page);
        return $this->dal_product->getListCateAjax($order,$direct,$number);
    }


    /*
     * Edit cate product
     * cateId: cate id
     * function getEditCate
     */
    public function getEditCate($cateId){
        $data['cate'] =  Cate_product::find($cateId);
        return $data;
    }

    /*
     * Execute edit cate product
     * function postEditCate
     */
    public function postEditCate($request){
        $cateId = $request->lbId;
        $array = [
            'cate_name' => $request->txtName,
            'cate_value' => $request->txtName,
            'cate_parent' => $request->sltCate,
            'cate_alias' => Common::CreateSlug($request->txtName),
        ];
        return $this->dal_product->updateCateProduct($cateId,$array) ? _ApiCode::SUCCESS : _ApiCode::ERROR_UNKNOWN;

    }

    /*
     * Execute add cate product
     * function postAddCate
     */
    public function postAddCate($request){
        $cate_parent = $request->sltCate;
        return $this->dal_product->createCateProduct([
            'cate_name' => $request->txtName,
            'cate_value' => $request->txtName,
            'cate_parent' => $cate_parent,
            'cate_tag' => '',
            'cate_alias' => Common::CreateSlug($request->txtName),
        ]) ? _ApiCode::SUCCESS : _ApiCode::ERROR_UNKNOWN;
    }
    #endregion


    #region *** HELPER FUNCTION ***
    public function fixWidthString($str,$num){
        $fixWidth = '000000000000000000000000000000';
        $fixWidth = $fixWidth.$str;
        $fixWidth = strrev(Common::text_limit(strrev($fixWidth),$num));
        return $fixWidth;
    }

    public function generateProductSKU($productId){
        $product = $this->dal_product->getDetailProduct($productId);
        $dt = Carbon::now();
        $strSKU = 'PD'.$this->fixWidthString($productId,4);
        $strSKU = $strSKU.$this->fixWidthString($product->prd_cate,2);
        $strSKU = $strSKU.$dt->format('DDDYY').'VN';
        return $strSKU;
    }

    public function generateOrderNunber($orderId){
        $order = $this->dal_order->getDetailOrder($orderId);
        $dt = Carbon::now();
        $numberOrder = 'VN';
        $numberOrder = $numberOrder.$this->fixWidthString($orderId,4);
        $numberOrder = $numberOrder.$this->fixWidthString($order->od_createdBy,4);
        $numberOrder = $numberOrder.$dt->format('DDDYY');
        return $numberOrder;
    }
    #endregion

}