<?php

namespace App\Http\Controllers\Admin;

use App\Helper\_ApiCode;
use App\Http\Business\Admin\BzProduct;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    protected $bzProduct;
    public function __construct(){
        parent::__construct();
        $this->bzProduct = new BzProduct();
    }


    #region *** PRODUCT ***
    public function index(){
        return view('admin.dashboard');
    }

    public function getListProduct(){
        return view('admin.product.list_product');
    }

    public function getListProductData(){
        return $this->bzProduct->getListProductData();
    }

    public function getListProductSearch(){
        return $this->bzProduct->getListProductSearch();
    }

    public function getEditProduct($prdId){
        $data = $this->bzProduct->getEditProduct($prdId);
        return view('admin.product.edit_product', compact('data'));
    }

    public function postEditProduct(Request $request){
        $errorCode = $this->bzProduct->postEditProduct($request);
        if($errorCode == _ApiCode::SUCCESS)
            return redirect()->back()->with(['success_message' => 'Chỉnh sửa sản phẩm thành công']);
        else
            return redirect()->back()->with(['error_message' => 'Chỉnh sửa sản phẩm không thành công']);
    }

    public function getAddProduct(){
        return view('admin.product.add_product');
    }

    public function postAddProduct(Request $request){
        $errorCode = $this->bzProduct->postAddProduct($request);
        if($errorCode == _ApiCode::SUCCESS)
            return redirect()->back()->with(['success_message' => 'Thêm mới sản phẩm thành công']);
        else
            return redirect()->back()->with(['error_message' => 'Thêm mới sản phẩm không thành công']);
    }

    public function getDeleteProduct($prdId){
        $errorCode = $this->bzProduct->getDeleteProduct($prdId);
        if($errorCode == _ApiCode::SUCCESS)
            return redirect()->back()->with(['flash_message' => 'Xóa sản phẩm thành công']);
        else
            return redirect()->back()->with(['error_message' => 'Xóa sản phẩm không thành công']);
    }

    public function uploadImageProduct(Request $request){
        return $this->bzProduct->uploadImageProduct($request);
    }

    public function deleteImageProduct($imgId){
        return $this->bzProduct->deleteImageProduct($imgId);
    }
    #endregion


    #region *** CATE PRODUCT ***
    /*
     * Get list cate article by type
     * id: type article
     * function getListCate
     */
    public function getListCate(){
        return view('admin.product.list_cate');
    }

    /*
     * Get list cate article by type
     * get data bind to datatable
     * id: type article
     * function getListCateData
     */
    public function getListCateData(){
        return $this->bzProduct->getListCateAjax();
    }

    /*
     * Edit cate article
     * cateId: cate id
     * function getEditCate
     */
    public function getEditCate($cateId){
        $data = $this->bzProduct->getEditCate($cateId);
        return view('admin.product.edit_cate',compact('data'));
    }

    /*
     * Execute edit cate article
     * function postEditCate
     */
    public function postEditCate(Request $request){
        $errorCode = $this->bzProduct->postEditCate($request);
        if($errorCode == _ApiCode::SUCCESS)
            return redirect()->back()->with(['success_message' => 'Chỉnh sửa danh mục thành công']);
        else
            return redirect()->back()->with(['error_message' => 'Chỉnh sửa danh mục không thành công']);
    }

    /*
     * Add cate article
     * id: cate parent/ or grand parent, corresponding type article
     * function getAddCate
     */
    public function getAddCate(){
        return view('admin.product.add_cate');
    }

    /*
     * Execute add cate article
     * function postAddCate
     */
    public function postAddCate(Request $request){
        $errorCode = $this->bzProduct->postAddCate($request);
        if($errorCode == _ApiCode::SUCCESS)
            return redirect()->back()->with(['success_message' => 'Thêm mới danh mục thành công']);
        else
            return redirect()->back()->with(['error_message' => 'Thêm mới danh mục không thành công']);
    }
    #endregion


    public function postUpload(){
        return $this->bzProduct->postUploadImage('product');
    }

}
