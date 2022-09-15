<?php
/**
 * Created by PhpStorm.
 * User: QuanVH
 * Date: 17/02/2017
 * Time: 21:54 CH
 */

namespace App\Http\Business\Admin;


use App\Helper\_ApiCode;
use App\Helper\Common;
use App\Http\DAL\DAL_Config;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Supplier_detail;
use App\Models\Supply;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use function PHPSTORM_META\type;
use TomLingham\Searchy\Facades\Searchy;

class BzSupplier extends BzAdmin
{
    public function getListSupplierData() {
        $number = $_GET['length'];
        $start = $_GET['start'];
        $search = $_GET['search']['value'];
        $page = round($start/$number)+1;
        Common::SetCurrentPage($page);
        $typeSupplier = $_GET['type'];
        $quanlityOrder = $_GET['quanlity'];
        $productSupplier = $_GET['product'];

        if($search != ''){
            $query = Searchy::search('supplier')->fields('sp_code' ,'sp_name', 'sp_phone')
                ->query($search)->getQuery()->whereNotIn('sp_status',[DAL_Config::STATUS_DELETED]);
            if ($typeSupplier & $typeSupplier > 0) $query = $query->where('sp_type',$typeSupplier);
            if ($quanlityOrder && $quanlityOrder > 0) $query = $query->where('sp_qualityOrder',$quanlityOrder);
            if ($productSupplier > 0) {
                $list_id_supplier = Supply::where('sp_product', $productSupplier)
                    ->pluck('sp_supply');
                $query = $query->whereIn('sp_id', $list_id_supplier);
            }
            $lstUser = \App\Models\Supplier::hydrate($query->orderBy('created_at', 'desc')->get()->toArray());

            return [
                'data' => $lstUser,
                'total' => 10,
            ];
        }
        else{
            $query = Supplier::whereNotIn('sp_status',[DAL_Config::STATUS_DELETED]);
            if ($typeSupplier & $typeSupplier > 0) $query = $query->where('sp_type',$typeSupplier);
            if ($quanlityOrder && $quanlityOrder > 0) $query = $query->where('sp_qualityOrder',$quanlityOrder);
            if ($productSupplier > 0) {
                $list_id_supplier = Supply::where('sp_product', $productSupplier)
                    ->pluck('sp_supply');
                $query = $query->whereIn('sp_id', $list_id_supplier);
            }
            return $query->orderBy('created_at', 'desc')->paginate($number);
        }
    }

    public function postAddSupplier($request){
        try {
            $array = [
                'sp_name' => $request->txtName,
                'sp_alias' => Common::createSlug($request->txtName),
                'sp_email' => $request->txtEmail,
                'sp_phone' => $request->txtPhone,
                'sp_city' => $request->sltCity,
                'sp_location' => $request->txtAddress,
                'sp_licenseId' => $request->license,
                'sp_numEmployee' => $request->txtNumEmployee,
                'sp_type' => $request->sltQuanlity,
                'sp_minQuantity' => $request->txtMinQuantity,
                'sp_maxQuantity' => $request->txtMaxQuantity,
                'sp_qualityOrder' => implode(",",$request->sltOrderQuanlity),
                'sp_status' => DAL_Config::USER_STATUS_PUBLIC,
            ];
            // get feature image
            $file = Input::file('imgFeature');
            if ($file) {
                $alias = $this->CommonUpload(DAL_Config::IMAGE_ALIAS_SUPPLIER . '/feature', $file);
                if ($alias) {
                    $this->imageCrop->MakeUserThumb($alias);
                    $array['sp_avatar'] = $alias;
                }
            }
            if ($request->txtOtherProduct && $request->txtOtherProduct != '') {
                $array['sp_otherProduct'] = $request->txtOtherProduct;
            }
            // get business license
            $businessLicense = DAL_Config::getConfigByLocale(5);
            end($businessLicense);
            $lastLicenseKey = key($businessLicense);
            if ($request->license == $lastLicenseKey) {
                $array['sp_businessLicense'] = $request->txtOtherLicense;
            } else {
                $array['sp_businessLicense'] = $businessLicense[$request->license]['id'];
            }
            if ($newSupplier = $this->dal_supplier->createSupplier($array)) {
                // add product
                if (isset($request->sltProduct)) {
                    foreach ($request->sltProduct as $productId) {
                        Supply::create([
                            'sp_supply' => $newSupplier->sp_id,
                            'sp_product' => $productId
                        ]);
                    }
                }
//                if ($request->txtOtherProduct && $request->txtOtherProduct != '') {

//                    $product = Product::create([
//                        'prd_name' => $request->txtOtherProduct,
//                        'prd_cate' => 2,
//                        'prd_createdBy' => \Auth::user()->user_id
//                    ]);
//                    if ($product && $product->prd_id) Supply::create([
//                        'sp_supply' => $newSupplier->sp_id,
//                        'sp_product' => $product->prd_id
//                    ]);
//                }
                $newSupplier->sp_code = $this->genSupplierCode($newSupplier->sp_id);
                $newSupplier->save();
                $this->uploadSupplierImage($newSupplier);

                $file2 = Input::file('idCardImg');
                if ($file2) {
                    $alias2 = $this->CommonUpload(DAL_Config::IMAGE_ALIAS_SUPPLIER . '/feature2', $file2);
                    if ($alias2) {
                        $this->imageCrop->MakeUserThumb($alias2);
                    }
                }

                $file3 = Input::file('businessLiImg');
                if ($file3) {
                    $alias3 = $this->CommonUpload(DAL_Config::IMAGE_ALIAS_SUPPLIER . '/feature3', $file3);
                    if ($alias3) {
                        $this->imageCrop->MakeUserThumb($alias3);
                    }
                }

                if ($request->bankAccount){
                    Supplier_detail::create([
                        'sp_supplier' => $newSupplier->sp_id,
                        'sp_type' => 1,
                        'sp_name' => 'bankAccount',
                        'sp_detail' => [
                            'title'=>'Tài khoản ngân hàng','value'=>$request->bankAccount
                        ]
                    ]);
                }

                if ($request->phonePersonal){
                    Supplier_detail::create([
                        'sp_supplier' => $newSupplier->sp_id,
                        'sp_type' => 1,
                        'sp_name' => 'phonePersonal',
                        'sp_detail' => [
                            'title'=>'SDT người phụ trách','value'=>$request->phonePersonal
                        ]
                    ]);
                }

                if ($request->emailPersonal){
                    Supplier_detail::create([
                        'sp_supplier' => $newSupplier->sp_id,
                        'sp_type' => 1,
                        'sp_name' => 'emailPersonal',
                        'sp_detail' => [
                            'title'=>'Email người phụ trách','value'=>$request->emailPersonal
                        ]
                    ]);
                }

                if ($request->numIDCard){
                    Supplier_detail::create([
                        'sp_supplier' => $newSupplier->sp_id,
                        'sp_type' => 1,
                        'sp_name' => 'numIDCard',
                        'sp_detail' => [
                            'title'=>'Số CMND','value'=>$request->numIDCard
                        ]
                    ]);
                }

                if ($file2){
                    Supplier_detail::create([
                        'sp_supplier' => $newSupplier->sp_id,
                        'sp_type' => 1,
                        'sp_name' => 'idCardImg',
                        'sp_detail' => [
                            'title'=>'Ảnh CMND','value'=>$alias2
                        ]
                    ]);
                }

                if ($file3){
                    Supplier_detail::create([
                        'sp_supplier' => $newSupplier->sp_id,
                        'sp_type' => 1,
                        'sp_name' => 'businessLiImg',
                        'sp_detail' => [
                            'title'=>'Ảnh giấy phép kinh doanh','value'=>$alias3
                        ]
                    ]);
                }
                
                if($request->sltOrder && $request->txtPriceUnit
                    && $request->sltOrder > 0 && $request->txtPriceUnit > 0){
                    $this->dal_order->createOrderDetail([
                        'od_type' => 9,
                        'od_order' => $request->sltOrder,
                        'od_name' => 'Supplier Collect',
                        'od_assigneeTo' => $newSupplier->sp_id,
                        'od_priceUnit' => doubleval($request->txtPriceUnit),
                        'od_priceNow' => 0,
                        'od_price' => 0,
                        'od_detail' => serialize([
                            'image' => '',
                            'note' => '',
                            'time_template' => 0,
                            'price_template' => 0,
                            'time_finish' => 0,
                            'material' => '',
                            'payment1' => '',
                            'payment2' => '',
                            'payment3' => '',
                        ]),
                        'od_priority' => 0,
                    ]);

                }

                return _ApiCode::SUCCESS;
            }
            return _ApiCode::ERROR_UNKNOWN;
        } catch (\Exception $e) {
//            log exception
            return _ApiCode::ERROR_UNKNOWN;
        }
    }

    public function getActiveSupplier($spId) {
        $supplier = $this->dal_supplier->getDetailSupplier($spId);
        if ($supplier && $supplier->sp_id){
            $supplier->sp_status = DAL_Config::STATUS_ACTIVE;
            if ($supplier->save()) return _ApiCode::SUCCESS;
        }
        return _ApiCode::ERROR_UNKNOWN;
    }

    public function addOrder($request){
        for($i=1;$i<=($request->quantityOrder);$i++){
            if(Input::file("imgProduct$i")) {
                $imgArray = [];
                foreach (Input::file("imgProduct$i") as $key => $file) {
                    $alias = $this->CommonUpload(DAL_Config::IMAGE_ALIAS_SUPPLIER . '/feature4', $file);
                    if ($alias) {
                        $this->imageCrop->MakeUserThumb($alias);
                        array_push($imgArray,$alias);
                    }
                }
                $imgArrayImp = implode(",",$imgArray);
            }

            if ($request->nameProduct[$i] || $alias || $request->quantityProduct[$i]
                || $request->qualityProduct[$i] || $request->priceProduct[$i]){
                Supplier_detail::create([
                    'sp_supplier' => $newSupplier->sp_id,
                    'sp_type' => 1,
                    'sp_name' => "orderProduct$i",
                    'sp_detail' => [
                        'title1'=>'Dòng sản phẩm','value1'=>$request->nameProduct[$i],
                        'title2'=>'Ảnh','value2'=>$imgArrayImp,
                        'title3'=>'Số lượng','value3'=>$request->quantityProduct[$i],
                        'title4'=>'Chất lượng','value4'=>$request->qualityProduct[$i],
                        'title5'=>'Giá sản xuất','value5'=>$request->priceProduct[$i]
                    ]
                ]);
            }  
        }
    }

    public function getCheckSupplier($phone){
        $supplier = Supplier::where('sp_phone', $phone)->where('sp_status',1)->first();
        if ($supplier && $supplier->sp_id) return true;
        else return false;
    }

    public function uploadSupplierImage(Supplier $supplier){
        if(Input::file('imageProduct')) {
            $imgArray = [];
            foreach (Input::file('imageProduct') as $key => $file) {
                $alias = $this->CommonUpload(DAL_Config::IMAGE_ALIAS_PRODUCT, $file);
                if ($alias) {
                    $this->imageCrop->MakeProductThumb($alias);
                    array_push($imgArray,$alias);
                }
            }
            $currentImgArray = Common::buildTagArray($supplier->sp_image);
            $imgArray = array_merge($imgArray,$currentImgArray);
            $supplier->sp_image = implode(",",$imgArray);
            $supplier->save();
        }
    }

    public function getEditSupplier($userid){
        return $this->dal_supplier->getDetailSupplier($userid);
    }

    public function postEditSupplier($request){
        try {
            $spId = $request->lbId;
            $supplier = $this->dal_supplier->getDetailSupplier($spId);
            $supplier->sp_name = $request->txtName;
            $supplier->sp_alias = Common::createSlug($request->txtName);
//            $supplier->sp_email = $request->txtEmail;
//            $supplier->sp_phone = $request->txtPhone;
            $supplier->sp_city = $request->sltCity;
            $supplier->sp_location = $request->txtAddress;
            $supplier->sp_licenseId = $request->license;
            $supplier->sp_numEmployee = $request->txtNumEmployee;
            $supplier->sp_type = $request->sltQuanlity;
            $supplier->sp_minQuantity = $request->txtMinQuantity;
            $supplier->sp_maxQuantity = $request->txtMaxQuantity;
            $supplier->sp_qualityOrder = implode(",",$request->sltOrderQuanlity);// get feature image
            $supplier->sp_otherProduct = $request->txtOtherProduct;
            $file = Input::file('imgFeature');
            if ($file) {
                $alias = $this->CommonUpload(DAL_Config::IMAGE_ALIAS_SUPPLIER . '/feature', $file);
                if ($alias) {
                    $this->imageCrop->RemoveThumb($supplier->sp_avatar);
                    $this->imageCrop->MakeUserThumb($alias);
                    $supplier->sp_avatar = $alias;
                }
            }// get business license
            $businessLicense = DAL_Config::getConfigByLocale(5);
            end($businessLicense);
            $lastLicenseKey = key($businessLicense);
            if ($request->license == $lastLicenseKey) {
                $supplier->sp_businessLicense = $request->txtOtherLicense;
            } elseif($request->license) {
                $supplier->sp_businessLicense = $businessLicense[$request->license]['name'];
            }
            if ($supplier->save()) {
                // get product cate other to edit, don't create new one
//                $otherProduct = $supplier->otherProduct->first();
                Supply::where('sp_supply', $supplier->sp_id)->delete();
//                if ($otherProduct && $otherProduct->prd_id) {
//                    if ($request->txtOtherProduct && $request->txtOtherProduct != '') {
//                        Supply::create([
//                            'sp_supply' => $supplier->sp_id,
//                            'sp_product' => $otherProduct->prd_id
//                        ]);
//                        $otherProduct->prd_name = $request->txtOtherProduct;
//                        $otherProduct->save();
//                    } else {
//                        $otherProduct->delete();
//                    }
//                }
                // add product
                if (isset($request->sltProduct)) {
                    foreach ($request->sltProduct as $productId) {
                        Supply::create([
                            'sp_supply' => $supplier->sp_id,
                            'sp_product' => $productId
                        ]);
                    }
                }
                $this->uploadSupplierImage($supplier);

                if ($request->bankAccount){
                    Supplier_detail::where('sp_name','bankAccount')->update([
                        'sp_detail' => [
                            'title'=>'Tài khoản ngân hàng','value'=>$request->bankAccount
                        ]
                    ]);
                }

                if ($request->phonePersonal){
                    Supplier_detail::where('sp_name','phonePersonal')->update([
                        'sp_detail' => [
                            'title'=>'SDT người phụ trách','value'=>$request->phonePersonal
                        ]
                    ]);
                }

                if ($request->emailPersonal){
                    Supplier_detail::where('sp_name','emailPersonal')->update([
                        'sp_detail' => [
                            'title'=>'Email người phụ trách','value'=>$request->emailPersonal
                        ]
                    ]);
                }

                if ($request->numIDCard){
                    Supplier_detail::where('sp_name','numIDCard')->update([
                        'sp_detail' => [
                            'title'=>'Email người phụ trách','value'=>$request->numIDCard
                        ]
                    ]);
                }

                $file2 = Input::file('idCardImg');
                if ($file2) {
                    $alias2 = $this->CommonUpload(DAL_Config::IMAGE_ALIAS_SUPPLIER . '/feature2', $file2);
                    if ($alias2) {
                        $this->imageCrop->MakeUserThumb($alias2);
                    }
                }

                $file3 = Input::file('businessLiImg');
                if ($file3) {
                    $alias3 = $this->CommonUpload(DAL_Config::IMAGE_ALIAS_SUPPLIER . '/feature3', $file3);
                    if ($alias3) {
                        $this->imageCrop->MakeUserThumb($alias3);
                    }
                }

                if ($file2){
                    Supplier_detail::where('sp_name','idCardImg')->update([
                        'sp_detail' => [
                            'title'=>'Ảnh CMND','value'=>$alias2
                        ]
                    ]);
                }

                if ($file3){
                    Supplier_detail::where('sp_name','businessLiImg')->update([
                        'sp_detail' => [
                            'title'=>'Ảnh giấy phép kinh doanh','value'=>$alias3
                        ]
                    ]);
                }
                       
                if($request->sltOrder && $request->txtPriceUnit
                    && $request->sltOrder > 0 && $request->txtPriceUnit > 0){
                    $this->dal_order->createOrderDetail([
                        'od_type' => 9,
                        'od_order' => $request->sltOrder,
                        'od_name' => 'Supplier Collect',
                        'od_assigneeTo' => $supplier->sp_id,
                        'od_priceUnit' => doubleval($request->txtPriceUnit),
                        'od_priceNow' => 0,
                        'od_price' => 0,
                        'od_detail' => serialize([
                            'image' => '',
                            'note' => '',
                            'time_template' => 0,
                            'price_template' => 0,
                            'time_finish' => 0,
                            'material' => '',
                            'payment1' => '',
                            'payment2' => '',
                            'payment3' => '',
                        ]),
                        'od_priority' => 0,
                    ]);

                }

                return _ApiCode::SUCCESS;
            }
            return _ApiCode::ERROR_UNKNOWN;
        } catch (\Exception $e) {
            //log exception
            activity()->performedOn(Supplier::getModel())
                ->causedBy(\Auth::user())
                ->withProperties(['action' => 'postEditSupplier'])
                ->log("line ".$e->getLine()." file ".$e->getFile() ."\n".$e->getMessage());
            \Log::error($e->getMessage(),$e->getTrace());
            return _ApiCode::ERROR_UNKNOWN;
        }
    }

    public function getDeleteSupplier($spId){
        $supplier = $this->dal_supplier->getDetailSupplier($spId);
        if ($supplier && $supplier->sp_id){
            $supplier->sp_status = DAL_Config::STATUS_DELETED;
            if ($supplier->save()) return _ApiCode::SUCCESS;
        }
        return _ApiCode::ERROR_UNKNOWN;
    }

    public function getDeleteImageSupplier($id, $imgId){
        try {
            $supplier = $this->dal_supplier->getDetailSupplier($id);
            $currentImgArray = Common::buildTagArray($supplier->sp_image);
            $alias = array_splice($currentImgArray, $imgId,1);
            if ($alias && $alias[0])
                $this->imageCrop->RemoveThumb($alias[0]);
            $supplier->sp_image = implode(",", $currentImgArray);
            $supplier->save();
            return _ApiCode::SUCCESS;
        } catch (\Exception $e) {
            //log exception
            activity()->performedOn(Supplier::getModel())
                ->causedBy(\Auth::user())
                ->withProperties(['action' => 'getDeleteImageSupplier'])
                ->log("line ".$e->getLine()." file ".$e->getFile() ."\n".$e->getMessage());
            \Log::error($e->getMessage(),$e->getTrace());
            return _ApiCode::ERROR_UNKNOWN;
        }
    }

    public function getSearchSupplier(){
        $result = array();
        if(isset($_GET['q'])) {
            $search = trim(mb_strtolower($_GET['q']));
            $lstSupplier = Searchy::search('supplier')->fields('sp_name','sp_code','sp_email','sp_phone')
                ->query($search)->get();
        }
        else
            $lstSupplier = Supplier::all();
        foreach ($lstSupplier as $supplier){
            array_push($result,['id'=>$supplier->sp_id,'text'=>"$supplier->sp_code"." - "."$supplier->sp_name"]);      
        }
        return $result;
    }

    public function genSupplierCode($id) {
        $dateCreate = Carbon::now();
        $numSupplier = $this->dal_supplier->getCountByMonth($id);
        return 'XM'.$dateCreate->format('ymd').$numSupplier;
    }

}