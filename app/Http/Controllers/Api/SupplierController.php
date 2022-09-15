<?php
/**
 * Created by PhpStorm.
 * User: QuanVH
 * Date: 17/02/2017
 * Time: 21:45 CH
 */

namespace App\Http\Controllers\Api;


use App\Helper\_ApiCode;
use App\Helper\Common;
use App\Http\Business\API\BzOrder;
use App\Http\Business\API\BzSupplier;
use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    protected $bzSupplier;
    protected $bzOrder;

    public function __construct()
    {
        parent::__construct();
        $this->bzSupplier = new BzSupplier();
        $this->bzOrder = new BzOrder();
    }

    public function getDetailSupplier($spId)
    {
        return response()->json(Common::buildApiResponse($this->bzSupplier->getSupplierWithRate($spId)));
    }

    public function getSupplierByUser($userId)
    {
        return response()->json(Common::buildApiResponse($this->bzSupplier->getSupplierFull($userId)));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @group SUPPLIER MANAGER INFO
     * Login
     * @urlParam \
     * @queryParam \
     * @bodyParam email string required
     * @bodyParam password string required
     * @response 200 {"data": {
     * "token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9",
     * "info": {
     *      "user_id": 1,
     *      "user_name": "abc",
     *      "user_showName": "Alium"
     * },
     * "newSupplier": false,
     * "supplierInfo": {
     *      "sp_id": 266,
     *      "sp_code": "XM2003301",
     *      "sp_name": "Xưởng abc",
     *      "sp_email": "abc@alium.vn",
     *      "sp_phone": null,
     *      "sp_banner": null
     * },
     * "dataSupplier":{
     *      "Genera info":{},
     *      "Business owner":{},
     *      "Oder process":{},
     *      "Order passed":[],
     *      "Advance info":{},
     *      "Service":{}
     * }
     * },  "status": 200, "message": "Success"}
     */
    public function login(Request $request)
    {
        return $this->bzSupplier->login($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @group SUPPLIER MANAGER INFO
     * Logout
     * @authenticated
     * @urlParam \
     * @queryParam \
     * @response 200 {"data": [], "status": 200, "message": "Successful"}
     */
    public function logout(Request $request)
    {
        return $this->bzSupplier->logout($request);
    }

    public function register(Request $request)
    {
        return response()->json(Common::buildApiResponse([], $this->bzSupplier->register($request)));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @group SUPPLIER MANAGER INFO
     * Get Info
     * @authenticated
     * @urlParam \
     * @queryParam \
     * @response 200 {"data": {
     * "supplier": {
     *      "sp_id": 266,
     *      "sp_code": "XM2003301",
     *      "sp_name": "Xưởng abc",
     *      "typeSupplier": "Không xác định",
     *      "qualityOrder": "Không xác định",
     *      "image": []
     * },
     * "Genera info": {
     *      "logo": "",
     *      "companyName": "Xưởng abc",
     *      "globalName": "",
     *      "businessCode": "123456",
     *      "businessImage": [],
     *      "email": "abc@alium.vn"
     * },
     * "Business owner": {
     *      "fullName": "Alium",
     *      "phone": "",
     *      "email": "",
     *      "address": "",
     *      "image": []
     * },
     * "Oder process": {
     *      "position": "",
     *      "fullName": "",
     *      "phone": "",
     *      "email": "",
     *      "address": "",
     *      "image": []
     * },
     * "Order passed": [],
     * "Advance info": {
     *      "certificate": "",
     *      "factoryImage": "",
     *      "profile": ""
     * },
     * "Service": {
     *      "logistic": "",
     *      "deliver": "",
     *      "deliverPartner": [],
     *      "otherService": [],
     *      "produceService": []
     * }
     * }, "status": 200, "message": "Success"}
     */
    public function getInfo(Request $request)
    {
        return response()->json(
            Common::buildApiResponse($this->bzSupplier->getSupplierInfo($request))
        );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @group SUPPLIER MANAGER INFO
     * Update Info
     * @authenticated
     * @urlParam \
     * @queryParam \
     * @bodyParam type string required type of info to update, one of [generalInfo, contact, service, advance]. Example: contact
     * @bodyParam sId integer required supplier ID
     * @bodyParam dataUpdate object required array of key=>value, only send if change value. Example: {"logo":"","companyName":"X\u01b0\u1edfng abc","globalName":"","businessCode":"123456","businessImage":[],"email":"abc@alium.vn","website":"","address":"","city":"","startYear":"","numEmployee":"","factoryAddress":[],"promotionText":"","typeOfProduct":1,"typeOfBusiness":1,"market":"","marketName":[],"historyBrand":[],"phone":"0987654321","licenseId":"112233"}
     * @response 200 {"data": [], "status": 200, "message": "Successful"}
     */
    public function updateInfo(Request $request)
    {
        $type = $request->type;
        if ($type == 'generalInfo') {
            return response()->json(Common::buildApiResponse([], $this->bzSupplier->updateGeneralInfo($request)));
        } elseif ($type == 'contact') {
            return response()->json(Common::buildApiResponse([], $this->bzSupplier->updateContact($request)));
        } elseif ($type == 'service') {
            return response()->json(Common::buildApiResponse([], $this->bzSupplier->updateService($request)));
        } elseif ($type == 'advance') {
            return response()->json(Common::buildApiResponse([], $this->bzSupplier->updateAdvanceInfo($request)));
        } elseif ($type == 'businessOwner') {
            return response()->json(Common::buildApiResponse([], $this->bzSupplier->updateOwner($request)));
        }
        return response()->json(Common::buildApiResponse([], _ApiCode::ERROR_UNKNOWN));
    }

    /**
     * @param int $page
     * @return \Illuminate\Http\JsonResponse
     * @group SUPPLIER MANAGER INFO
     * Get List Order
     * @authenticated
     * @urlParam \
     * @queryParam page Number of page (integer)
     * @response 200 {"data": [], "status": 200, "message": "Successful"}
     */
    public function getListOrder()
    {
        $state = isset($_GET['state']) ? $_GET['state'] : 'all';
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        return response()->json(
            Common::buildApiResponse($this->bzSupplier->getListOrder($state, $search))
        );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @group SUPPLIER MANAGER INFO
     * Add Order
     * @authenticated
     * @urlParam \
     * @queryParam \
     * @bodyParam unit string required Currency
     * @bodyParam priceUnit integer required price per unit
     * @bodyParam minQuantity integer required number of unit
     * @bodyParam color array list of color
     * @bodyParam brand array list of brand
     * @bodyParam material string
     * @bodyParam size string explain size
     * @bodyParam video string youtube video link
     * @bodyParam hide bool required hide/show order
     * @bodyParam pdf_file string optional Pdf file
     * @bodyParam od_product integer required product ID of order
     * @bodyParam imgId string list of image, separate by comma
     * @response 200 {"data": [], "status": 200, "message": "Successful"}
     */
    public function addOrder(Request $request)
    {
        return response()->json(
            Common::buildApiResponse([], $this->bzSupplier->addOrder($request))
        );
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @group SUPPLIER MANAGER INFO
     * Upload Image
     * @authenticated
     * @urlParam \
     * @queryParam \
     * @bodyParam file file required File to upload
     * @bodyParam pdf file required Pdf file to upload (require at least one file image or pdf)
     * @response 200 {"data": [], "status": 200, "message": "Successful"}
     */
    public function uploadImage()
    {
        return $this->bzSupplier->uploadImage();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @group SUPPLIER MANAGER INFO
     * Upload Image Order
     * @authenticated
     * @urlParam \
     * @queryParam \
     * @bodyParam file file required File to upload
     * @response 200 {"data": [], "status": 200, "message": "Successful"}
     */
    public function uploadImageOrder()
    {
        return $this->bzSupplier->uploadImageOrder();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @group SUPPLIER MANAGER INFO
     * Update Order
     * @authenticated
     * @urlParam \
     * @queryParam \
     * @bodyParam odId integer required order id to be update
     * @bodyParam dataUpdate object required array of key=>value, send empty object if don't change value
     * @bodyParam imgId string list of image id if user upload new image. Example: 100,102,123
     * @bodyParam pdf_file file pdf file if user upload file
     * @response 200 {"data": [], "status": 200, "message": "Successful"}
     */
    public function updateOrder(Request $request)
    {
        return response()->json(
            Common::buildApiResponse($this->bzSupplier->updateOrder($request))
        );
    }

    /**
     * @param $imgId
     * @return \Illuminate\Http\JsonResponse
     * @group SUPPLIER MANAGER INFO
     * Delete Image Order
     * @authenticated
     * @urlParam {id} string required url/image_id from server when uploaded image
     * @queryParam \
     * @response 200 {"data": [], "status": 200, "message": "Successful"}
     */
    public function deleteImage($imgId = -1)
    {
        return response()->json(
            Common::buildApiResponse([], $this->bzSupplier->deleteImage($imgId))
        );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @group SUPPLIER MANAGER INFO
     * Update User Info
     * @authenticated
     * @urlParam \
     * @queryParam \
     * @bodyParam dataUpdate object array of key=>value, don't send info if don't change value
     * @bodyParam dataUpdate.user_showName string
     * @bodyParam dataUpdate.user_phone string
     * @bodyParam dataUpdate.user_city number number of city
     * @bodyParam dataUpdate.user_address string
     * @bodyParam dataUpdate.user_birthday string format 'yyyy/mm/dd'
     * @bodyParam dataUpdate.user_gender string nam/nu
     * @bodyParam newPassword: string if change password
     * @response 200 {"data": [], "status": 200, "message": "Successful"}
     */
    public function postEditInfo(Request $request)
    {
        return response()->json(
            Common::buildApiResponse([], $this->bzSupplier->postEditInfo($request))
        );
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @group SUPPLIER MANAGER INFO
     * Get list customer order
     * @authenticated
     * @urlParam \
     * @queryParam \
     * @bodyParam type string required type of info to update, one of [cancel, transport, rate, bid]. Example: bid
     * @bodyParam dataUpdate object required array of key=>value, only send if change value. Example: {"priceUnit":"100000","timeFinish":"8","material":"Cotton 70%", "note":"restore at 10/10/1990"}
     * @response 200 {"data": [], "status": 200, "message": "Successful"}
     */
    public function getListOrderCustomer()
    {
        $supplier = Supplier::where('sp_manager', Auth::user()->user_id)->first();
        $state = isset($_GET['state']) ? $_GET['state'] : 'all';
        if ($supplier && $supplier->sp_id) {
            return response()->json(
                Common::buildApiResponse($this->bzOrder->getListOrderBySupplier($supplier->sp_id, $state))
            );
        }
        return response()->json(Common::buildApiResponse([]));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @group SUPPLIER MANAGER INFO
     * Get detail customer order
     * @authenticated
     * @urlParam \
     * @queryParam \
     * @bodyParam type string required type of info to update, one of [cancel, transport, rate, bid]. Example: bid
     * @bodyParam dataUpdate object required array of key=>value, only send if change value. Example: {"priceUnit":"100000","timeFinish":"8","material":"Cotton 70%", "note":"restore at 10/10/1990"}
     * @response 200 {"data": [], "status": 200, "message": "Successful"}
     */
    public function getDetailOrderCustomer()
    {
        $supplier = Supplier::where('sp_manager', Auth::user()->user_id)->first();
        return response()->json(Common::buildApiResponse([
            'order' => $this->bzOrder->getDetailOrderSupplier($_GET['odCode'], false),
            'orderDetail' => $this->bzOrder->getDetailOrderCustomer($_GET['odCode'], $supplier->sp_id),
            'orderDetailSP' => $this->bzOrder->getDetailOrderCustomerSP($_GET['odCode'], $supplier->sp_id)
        ]));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @group SUPPLIER MANAGER INFO
     * Process customer order
     * @authenticated
     * @urlParam \
     * @queryParam \
     * @bodyParam type string required type of info to update, one of [cancel, transport, rate, bid]. Example: bid
     * @bodyParam dataUpdate object required array of key=>value, only send if change value. Example: {"priceUnit":"100000","timeFinish":"8","material":"Cotton 70%", "note":"restore at 10/10/1990"}
     * @response 200 {"data": [], "status": 200, "message": "Successful"}
     */
    public function processOrder(Request $request)
    {
        return $this->bzOrder->processOrder($request);
    }

    public function addBankAccount(Request $request)
    {
        return $this->bzSupplier->addBankAccount($request);
    }

    public function editBankAccount(Request $request)
    {
        return response()->json(
            Common::buildApiResponse([], $this->bzSupplier->postEditBankAccount($request))
        );
    }

    public function getListBankAccount()
    {
        return response()->json(
            Common::buildApiResponse($this->bzSupplier->getListBankAccount())
        );
    }

    public function getDetailBankAccount($id)
    {
        return response()->json(
            Common::buildApiResponse($this->bzSupplier->getDetailBankAccount($id))
        );
    }

    public function getRevenue()
    {
        $supplier = Supplier::where('sp_manager', Auth::user()->user_id)->first();
        $rangeMonth = isset($_GET['range']) ? $_GET['range'] : 6;
        if ($supplier && $supplier->sp_id) {
            return response()->json(
                Common::buildApiResponse($this->bzOrder->getRevenue($supplier->sp_id, $rangeMonth))
            );
        }
        return response()->json(Common::buildApiResponse([]));
    }

    public function getRevenueProduct()
    {
        $supplier = Supplier::where('sp_manager', Auth::user()->user_id)->first();
        $rangeMonth = isset($_GET['range']) ? $_GET['range'] : 6;
        if ($supplier && $supplier->sp_id) {
            return response()->json(
                Common::buildApiResponse(
                    $this->bzOrder->getRevenueProduct($supplier->sp_id, $rangeMonth))
            );
        }
        return response()->json(Common::buildApiResponse([]));
    }

    public function getOrderStatistic()
    {
        $supplier = Supplier::where('sp_manager', Auth::user()->user_id)->first();
        $rangeMonth = isset($_GET['range']) ? $_GET['range'] : 6;
        if ($supplier && $supplier->sp_id) {
            return response()->json(
                Common::buildApiResponse(
                    $this->bzOrder->getOrderStatistic($supplier->sp_id, $rangeMonth))
            );
        }
        return response()->json(Common::buildApiResponse([]));
    }

    public function getTopOrder()
    {
        $supplier = Supplier::where('sp_manager', Auth::user()->user_id)->first();
        $rangeMonth = isset($_GET['range']) ? $_GET['range'] : 6;
        if ($supplier && $supplier->sp_id) {
            return response()->json(
                Common::buildApiResponse(
                    $this->bzOrder->getTopOrder($supplier->sp_id, $rangeMonth))
            );
        }
        return response()->json(Common::buildApiResponse([]));
    }
}