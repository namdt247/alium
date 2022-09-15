<?php
/**
 * Created by PhpStorm.
 * Project: Alium_main
 * User: quanvu
 * Date: 13/07/2019
 */


namespace App\Http\Business\API;


use App\Helper\_ApiCode;
use App\Helper\_ApiMessage;
use App\Helper\_ObjectType;
use App\Helper\Common;
use App\Http\DAL\DAL_Config;
use App\Http\DAL\DAL_Supplier;
use App\Models\City;
use App\Models\Device_token;
use App\Models\Order;
use App\Models\Order_supplier;
use App\Models\Rating;
use App\Models\Supplier;
use App\Models\Supplier_detail;
use App\Models\Supply;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use TomLingham\Searchy\Facades\Searchy;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class BzSupplier extends BzApi
{
    protected $dal_supplier;

    public function __construct()
    {
        parent::__construct();
        $this->dal_supplier = new DAL_Supplier();
    }

    public function getDetailSupplier($spId)
    {
        return Supplier::find($spId);
    }

    public function getSupplierWithRate($spId)
    {
        $supplier = $this->dal_supplier->getDetailSupplier($spId);
        $lstRate = $this->getListRateSupplier($spId);
        return [
            'supplier' => $supplier,
            'rate' => $lstRate
        ];
    }

    public function getSupplierFull($userId)
    {
        $userOwner = User::where('user_id', $userId)->first();
        $supplier = Supplier::where('sp_user', $userId)->first();
        if ($supplier && $supplier->sp_id) {
            return [
                'supplier' => $supplier,
                'rate' => $this->getListRateSupplier($supplier->sp_id),
                'detail' => $this->getListDetailSupplier($supplier->sp_id),
                'owner' => $userOwner,
                'manager' => $this->getListManagerSupplier($supplier->sp_manager),
            ];
        }
    }

    public function getListRateSupplier($spId)
    {
        $lstOrder = Order::where('od_assigneeTo', $spId)->pluck('od_id');
        return Rating::where('rate_targetType', Order::class)
            ->whereIn('rate_targetId', $lstOrder)->get();
    }

    public function getListDetailSupplier($spId)
    {
        return Supplier_detail::where('sp_supplier', $spId)->get();
    }

    public function getListManagerSupplier($manager)
    {
        return User::whereIn('user_id', Common::buildTagArray($manager))
            ->whereNotIn('user_status', [DAL_Config::STATUS_DELETED])->get();
    }

    public function getListOrderSupplier($spId)
    {
        $lstOrder = Order::where('od_assigneeTo', $spId)->get();
        return $lstOrder;
    }

    public function login($request)
    {
        $credentialMail = [
            'user_email' => $request->get('email'),
            'password' => $request->get('password')
        ];
        $credentialPhone = [
            'user_phone' => $request->get('email'),
            'password' => $request->get('password')
        ];

        $token = null;
        $user = null;
        $newSupplier = true;
        $dataSupplier = [];
        $countNotify = 0;
        try {
            $token = JWTAuth::attempt($credentialPhone) ? JWTAuth::attempt($credentialPhone) :
                JWTAuth::attempt($credentialMail);
            if (!$token) {
                return response()->json(
                    Common::buildApiResponse([], _ApiCode::ERROR_INFO, _ApiMessage::LOGIN_INFO_ERROR)
                );
            } else {
                //get push token
                if (isset($request->fcmToken) && $request->fcmToken != '') {
                    $this->saveToken($request->fcmToken);
                }
                $user = auth()->user();
                if ($user->user_status == 2) {
                    // user pending
                    return response()->json(
                        Common::buildApiResponse([], _ApiCode::USER_PENDING, _ApiMessage::USER_PENDING)
                    );
                }
                elseif ($user->user_status == 3 || $user->user_status == -1) {
                    // user lock
                    return response()->json(
                        Common::buildApiResponse([], _ApiCode::USER_LOCK, _ApiMessage::USER_LOCK)
                    );
                }
                $user->countNotify = $this->countNotifySupplier();
                $user->countOrderBid = $this->countOrderBid();
                $user->city = City::find($user->user_city);
                $supplierInfo = Supplier::where('sp_manager', $user->user_id)->first();
                if ($supplierInfo && $supplierInfo->sp_id) {
                    $newSupplier = false;
                } else {
                    $newSupplier = true;
                    $dataSupplier = [];
                }
            }
        } catch (JWTException $e) {
            return response()->json(
                Common::buildApiResponse([],
                    _ApiCode::CREATE_TOKEN_FAILED,
                    _ApiMessage::CREATE_TOKEN_FAILED)
            );
        }
        return response()->json(Common::buildApiResponse([
            'token' => $token,
            'info' => $user,
            'newSupplier' => $newSupplier,
            'supplierInfo' => $supplierInfo,
        ]));
    }

    public function countNotifySupplier(){
        $list_notify = Auth::user()->unreadNotifications()->get();
        $lstNotify = [];
        foreach ($list_notify as $notify) {
            if ($notify->data['cate'] == 2) {
                array_push($lstNotify, $notify);
            }
        }
        return count($lstNotify);
    }

    public function saveToken($token)
    {
        if ($token && $token != '' && $token != 'null') {
            Device_token::create([
                'token_user' => auth()->user()->user_id,
                'token_device' => 'web supplier',
                'token_value' => $token,
                'token_push' => '',
                'token_expire' => '',
                'token_lastLogin' => Carbon::now(),
            ]);
            return _ApiCode::SUCCESS;
        }
    }

    public function logout($request)
    {
        try {
            JWTAuth::parseToken()->invalidate(true);
            return response()->json(
                Common::buildApiResponse([], _ApiCode::SUCCESS, _ApiMessage::SUCCESS)
            );
        } catch (JWTException $e) {
            return response()->json(Common::buildApiResponse([],
                _ApiCode::LOGOUT_FAILED, _ApiCode::LOGOUT_FAILED));
        }
    }

    public function register($request)
    {
        //input email, phone, owner name, company name, type of product, type of business, business code, business image
        $user = Auth::user();
        if ($user && $user->user_id) {
            $email = strtolower($request->get('email'));
            $newSupplier = Supplier::create([
                'sp_manager' => $user->user_id,
                'sp_name' => $request->get('company'),
                'sp_alias' => Common::createSlug($request->get('company')),
                'sp_email' => $email
            ]);

            if ($newSupplier && $newSupplier->sp_id) {
                $generalInfo = $this->dal_supplier->getDefaultSupplierInfo(_ObjectType::KEY_GENERAL_INFO);
                $generalInfo['companyName'] = $request->get('company');
                $generalInfo['email'] = $email;
                $generalInfo['phone'] = $request->get('phone');
                $generalInfo['typeOfBusiness'] = $request->get('typeBusiness');
                $generalInfo['typeOfProduct'] = $request->get('typeProduct');
                $generalInfo['businessCode'] = $request->get('businessCode');
                $generalInfo['licenseId'] = $request->get('licenseId');
                $generalInfo['businessImage'] = [];

                $listImage = $request->businessImage;
                if (is_array($listImage)) $arrImage = $listImage;
                else $arrImage = explode(',', $listImage);
                foreach ($arrImage as $img) {
                    if (strlen($img) > 0) {
                        array_push($generalInfo['businessImage'], $img);
                    }
                }

                $this->dal_supplier->setSupplierInfo($newSupplier->sp_id, _ObjectType::KEY_GENERAL_INFO, $generalInfo);
                $businessOwnerInfo = $this->dal_supplier->getDefaultSupplierInfo(_ObjectType::KEY_BUSINESS_OWNER);
                $businessOwnerInfo['fullName'] = $request->get('fullName');
                $this->dal_supplier->setSupplierInfo($newSupplier->sp_id,
                    _ObjectType::KEY_BUSINESS_OWNER, $businessOwnerInfo);
                $this->dal_supplier->setSupplierInfo($newSupplier->sp_id,
                    _ObjectType::KEY_ORDER_PROCESS,
                    $this->dal_supplier->getDefaultSupplierInfo(_ObjectType::KEY_ORDER_PROCESS));
                $this->dal_supplier->setSupplierInfo($newSupplier->sp_id,
                    _ObjectType::KEY_ADVANCE_INFO,
                    $this->dal_supplier->getDefaultSupplierInfo(_ObjectType::KEY_ADVANCE_INFO));
                $this->dal_supplier->setSupplierInfo($newSupplier->sp_id,
                    _ObjectType::KEY_SERVICE,
                    $this->dal_supplier->getDefaultSupplierInfo(_ObjectType::KEY_SERVICE));
                $newSupplier->sp_code = $this->genSupplierCode($newSupplier->sp_id);
                $newSupplier->save();

                return _ApiCode::SUCCESS;
            }

        }
        return _ApiCode::ERROR_UNKNOWN;
    }

    public function genSupplierCode($id)
    {
        $dateCreate = Carbon::now();
        $numSupplier = $this->dal_supplier->getCountByMonth($id);
        return 'XM' . $dateCreate->format('ymd') . $numSupplier;
    }

    public function getSupplierInfo($request)
    {
        $user = JWTAuth::toUser($request->token);
        $user->city = City::find($user->user_city);
        $user->countNotify = $this->countNotifySupplier();
        $user->countOrderBid = $this->countOrderBid();
        if ($user && $user->user_id) {
            $supplier = Supplier::where('sp_manager', $user->user_id)->first();
            if ($supplier && $supplier->sp_id) {
                return [
                    'info' => $user,
                    'supplierInfo' => $this->dal_supplier->getDetailSupplier($supplier->sp_id),
                    'newSupplier' => false,
                    'dataSupplier' => [
                        _ObjectType::KEY_GENERAL_INFO => $this->dal_supplier->getSupplierInfo($supplier->sp_id, _ObjectType::KEY_GENERAL_INFO),
                        _ObjectType::KEY_BUSINESS_OWNER => $this->dal_supplier->getSupplierInfo($supplier->sp_id, _ObjectType::KEY_BUSINESS_OWNER),
                        _ObjectType::KEY_ORDER_PROCESS => $this->dal_supplier->getSupplierInfo($supplier->sp_id, _ObjectType::KEY_ORDER_PROCESS),
                        _ObjectType::KEY_ORDER_PASS => $this->dal_supplier->getSupplierInfo($supplier->sp_id, _ObjectType::KEY_ORDER_PASS),
                        _ObjectType::KEY_ADVANCE_INFO => $this->dal_supplier->getSupplierInfo($supplier->sp_id, _ObjectType::KEY_ADVANCE_INFO),
                        _ObjectType::KEY_SERVICE => $this->dal_supplier->getSupplierInfo($supplier->sp_id, _ObjectType::KEY_SERVICE),
                        _ObjectType::KEY_PRODUCT => $this->getListProduct($supplier->sp_id),
                    ],
                ];
            } else {
                return [
                    'info' => $user,
                    'newSupplier' => true,
                    'supplierInfo' => null
                ];
            }
        }
    }

    public function updateGeneralInfo($request)
    {
        return $this->updateSupplierInfo($request->sId, _ObjectType::KEY_GENERAL_INFO, $request->dataUpdate);
    }

    public function updateOwner($request)
    {
        return $this->updateSupplierInfo($request->sId, _ObjectType::KEY_BUSINESS_OWNER, $request->dataUpdate);
    }

    public function updateContact($request)
    {
        return $this->updateSupplierInfo($request->sId, _ObjectType::KEY_ORDER_PROCESS, $request->dataUpdate);
    }

    public function updateService($request)
    {
        return $this->updateSupplierInfo($request->sId, _ObjectType::KEY_SERVICE, $request->dataUpdate);
    }

    public function updateAdvanceInfo($request)
    {
        return $this->updateSupplierInfo($request->sId, _ObjectType::KEY_ADVANCE_INFO, $request->dataUpdate);
    }

    public function updateSupplierInfo($sId, $keyName, $data)
    {
        try {
            $currentData = $this->dal_supplier->getSupplierInfo($sId, $keyName);
            foreach ($data as $key => $value) {
                if (array_key_exists($key, $currentData)) {
                    $currentData[$key] = $value;
                }
            }
            $this->dal_supplier->setSupplierInfo($sId, $keyName, $currentData);
            return _ApiCode::SUCCESS;
        } catch (\Exception $e) {
            activity()->performedOn(Supplier::getModel())
                ->causedBy(Auth::user())
                ->withProperties(['action' => 'updateSupplierInfo'])
                ->log("line " . $e->getLine() . " file " . $e->getFile() . "\n" . $e->getMessage());
            \Log::error($e->getMessage(), $e->getTrace());
            return _ApiCode::ERROR_UNKNOWN;
        }
    }

    public function getListOrder($state, $search)
    {
        $lstOrder = [];
        $user = Auth::user();
        $supplier = Supplier::where('sp_manager', $user->user_id)->first();
        try {
            if ($search != '') {
                $query = Searchy::search('order')->fields('od_code')
                    ->query($search)->getQuery()
                    ->where('od_status', 101)
                    ->where('od_assigneeTo', $supplier->sp_id);
                $list_order_id = [];

                // active status = 1
                if ($state == 'active') {
                    $list_order = $query->get();
                    foreach ($list_order as $order) {
                        $od_content = unserialize($order->od_content);
                        if (isset($od_content['status'])) {
                            if ($od_content['status'] == 1) {
                                array_push($list_order_id, $order->od_id);
                            }
                        }
                    }
                    $query = $query->whereIn('od_id', $list_order_id)
                        ->orderBy('created_at', 'desc');
                // hide status = 2
                } elseif ($state == 'hide') {
                    $list_order = $query->get();
                    foreach ($list_order as $order) {
                        $od_content = unserialize($order->od_content);
                        if (isset($od_content['status'])) {
                            if ($od_content['status'] == 2) {
                                array_push($list_order_id, $order->od_id);
                            }
                        }
                    }
                    $query = $query->whereIn('od_id', $list_order_id)
                        ->orderBy('created_at', 'desc');
                // hide status = 3
                } elseif ($state == 'lock') {
                    $list_order = $query->get();
                    foreach ($list_order as $order) {
                        $od_content = unserialize($order->od_content);
                        if (isset($od_content['status'])) {
                            if ($od_content['status'] == 3) {
                                array_push($list_order_id, $order->od_id);
                            }
                        }
                    }
                    $query = $query->whereIn('od_id', $list_order_id)
                        ->orderBy('created_at', 'desc');
                // all
                } else {
                    $query = $query->orderBy('created_at', 'desc');
                }
                $lstOrder = Order::hydrate($query->limit(30)->get()->toArray());
                foreach ($lstOrder as $order) {
                    $order->image = $order->image;
                }

            } else {
                $query = Order::where('od_status', 101)
                    ->where('od_assigneeTo', $supplier->sp_id);
                $list_order_id = [];

                if ($state == 'active') {
                    $list_order = $query->get();
                    foreach ($list_order as $order) {
                        $od_content = unserialize($order->od_content);
                        if (isset($od_content['status'])) {
                            if ($od_content['status'] == 1) {
                                array_push($list_order_id, $order->od_id);
                            }
                        }
                    }
                    $lstOrder = Order::whereIn('od_id', $list_order_id)
                        ->orderBy('created_at', 'desc')
                        ->paginate(20);
                } elseif ($state == 'hide') {
                    $list_order = $query->get();
                    foreach ($list_order as $order) {
                        $od_content = unserialize($order->od_content);
                        if (isset($od_content['status'])) {
                            if ($od_content['status'] == 2) {
                                array_push($list_order_id, $order->od_id);
                            }
                        }
                    }
                    $lstOrder = Order::whereIn('od_id', $list_order_id)
                        ->orderBy('created_at', 'desc')
                        ->paginate(20);
                } elseif ($state == 'lock') {
                    $list_order = $query->get();
                    foreach ($list_order as $order) {
                        $od_content = unserialize($order->od_content);
                        if (isset($od_content['status'])) {
                            if ($od_content['status'] == 3) {
                                array_push($list_order_id, $order->od_id);
                            }
                        }
                    }
                    $lstOrder = Order::whereIn('od_id', $list_order_id)
                        ->orderBy('created_at', 'desc')
                        ->paginate(20);
                } else {
                    $lstOrder = $query->orderBy('created_at', 'desc')
                        ->paginate(20);
                }
            }

        } catch (\Exception $e) {
            activity()->performedOn(Order::getModel())
                ->causedBy(Auth::user())
                ->withProperties(['action' => 'listOrder'])
                ->log("line " . $e->getLine() . " file " . $e->getFile() . "\n" . $e->getMessage());
            \Log::error($e->getMessage(), $e->getTrace());
        }

        return [
            'lstOrder' => $lstOrder,
            'totalOrderSpAll' => $this->totalOrderSupplier($supplier->sp_id, 0),
            'totalOrderSpActive' => $this->totalOrderSupplier($supplier->sp_id, 1),
            'totalOrderSpHide' => $this->totalOrderSupplier($supplier->sp_id, 2),
            'totalOrderSpLock' => $this->totalOrderSupplier($supplier->sp_id, 3),
        ];
    }

    public function totalOrderSupplier($spId, $status) {
        $query = Order::where('od_status', 101)
            ->where('od_assigneeTo', $spId);
        $list_order_id = [];

        if ($status == 1) {
            $list_order = $query->get();
            foreach ($list_order as $order) {
                $od_content = unserialize($order->od_content);
                if (isset($od_content['status'])) {
                    if ($od_content['status'] == $status) {
                        array_push($list_order_id, $order->od_id);
                    }
                }
            }
            return Order::whereIn('od_id', $list_order_id)->count();
        } elseif ($status == 2) {
            $list_order = $query->get();
            foreach ($list_order as $order) {
                $od_content = unserialize($order->od_content);
                if (isset($od_content['status'])) {
                    if ($od_content['status'] == $status) {
                        array_push($list_order_id, $order->od_id);
                    }
                }
            }
            return Order::whereIn('od_id', $list_order_id)->count();
        } elseif ($status == 3) {
            $list_order = $query->get();
            foreach ($list_order as $order) {
                $od_content = unserialize($order->od_content);
                if (isset($od_content['status'])) {
                    if ($od_content['status'] == $status) {
                        array_push($list_order_id, $order->od_id);
                    }
                }
            }
            return Order::whereIn('od_id', $list_order_id)->count();
        } else {
            return $query->count();
        }
    }

    public function addBankAccount($request)
    {
        try {
            $supplier = Supplier::where('sp_manager', Auth::user()->user_id)->first();
            $bank_id = Supplier_detail::where('sp_supplier', $supplier->sp_id)
                ->where('sp_type', 1)
                ->where('sp_status', 1)
                ->count();

            $detailBankAccount = [
                'id' => $bank_id + 1,
                'name' => $request->name,
                'numIDCard' => $request->numIDCard,
                'bankOwner' => $request->bankOwner,
                'bankAccountNum' => $request->bankAccountNum,
                'bankName' => $request->bankName,
                'bankCity' => $request->bankCity,
                'bankBranch' => $request->bankBranch
            ];

            Supplier_detail::create([
                'sp_supplier' => $supplier->sp_id,
                'sp_type' => 1,
                'sp_name' => 'bankAccount',
                'sp_detail' => $detailBankAccount
            ]);

            return Common::buildApiResponse([], _ApiCode::SUCCESS);
        } catch (\Exception $e) {
            return Common::buildApiResponse([], _ApiCode::ERROR_UNKNOWN);
        }
        
    }

    public function getListBankAccount() 
    {
        $user = Auth::user();
        $supplier = Supplier::where('sp_manager', $user->user_id)->first();
        if ($supplier && $supplier->sp_id) {
            return Supplier_detail::where('sp_supplier', $supplier->sp_id)
                ->where('sp_name', _ObjectType::KEY_BANK_ACCOUNT)
                ->orderBy('created_at', 'desc')
                ->select('sp_detail')->get();
        }
    }

    public function getDetailBankAccount($id)
    {
        $supplier = Supplier::where('sp_manager', Auth::user()->user_id)->first();
        $bankAccount = Supplier_detail::where('sp_supplier', $supplier->sp_id)
            ->where('sp_name', _ObjectType::KEY_BANK_ACCOUNT)
            ->where('sp_status', 1)
            ->where('sp_detail->id', $id)
            ->first();
        return $bankAccount;
    }

    public function postEditBankAccount($request)
    {
        try {
            $supplier = Supplier::where('sp_manager', Auth::user()->user_id)->first();
            $existBankAccount = Supplier_detail::where('sp_supplier', $supplier->sp_id)
                ->where('sp_name', _ObjectType::KEY_BANK_ACCOUNT)
                ->where('sp_status', 1)
                ->where('sp_detail->id', $request->bankId)
                ->first();
            if($existBankAccount) {
                $detailBankAccount = [
                    'id' => $request->bankId,
                    'name' => $request->name,
                    'numIDCard' => $request->numIDCard,
                    'bankOwner' => $request->bankOwner,
                    'bankAccountNum' => $request->bankAccountNum,
                    'bankName' => $request->bankName,
                    'bankCity' => $request->bankCity,
                    'bankBranch' => $request->bankBranch
                ];
                Supplier_detail::where('sp_supplier', $supplier->sp_id)
                    ->where('sp_name', _ObjectType::KEY_BANK_ACCOUNT)
                    ->where('sp_status', 1)
                    ->where('sp_detail->id', $request->bankId)
                    ->update(['sp_detail' => json_encode($detailBankAccount)]);
                return _ApiCode::SUCCESS;
            }
            return _ApiCode::ERROR_UNKNOWN;
        } catch (\Exception $ex) {
            return _ApiCode::ERROR_UNKNOWN;
        }
    }

    public function addOrder($request)
    {
        try {
            $user = Auth::user();
            $supplier = Supplier::where('sp_manager', $user->user_id)->first();
            $orderContent = [
                'unit' => $request->unit,
                'priceUnit' => $request->priceUnit,
                'minQuantity' => $request->minQuantity,
                'color' => implode(',', ($request->color)),
                'brand' => implode(',', ($request->brand)),
                'material' => $request->material,
                'size' => implode(',', ($request->size)),
                'status' => 1,
                'video' => $request->video,
                'file' => $request->pdf_file,
            ];
            if ($request->hide) {
                //hide order status, status 3 for locked order
                $orderContent['status'] = 2;
            }
            $orderData = [
                'od_name' => '',
                'od_phone' => '',
                'od_email' => '',
                'od_country' => $user->user_country ?? 0,
                'od_city' => $user->user_city ?? 0,
                'od_district' => $user->user_district ?? 0,
                'od_address' => $user->user_address,
                'od_postalCode' => $user->user_postalCode ?? 0,
                'od_product' => $request->od_product,
                'od_status' => 101,
                'od_requiredType' => '',
                'od_type' => 0,
                'od_message' => '',
                'od_requiredDate' => '',
                'od_wantedPrice' => 0,
                'od_createdBy' => 1,
                'od_content' => serialize($orderContent),
                'od_assigneeTo' => $supplier->sp_id
            ];
            if ($newOrder = $this->dal_order->createOrder($orderData)) {
                //upload image
                $listImageId = $request->imgId;
                if (is_array($listImageId)) $arrImageId = $listImageId;
                else $arrImageId = explode(',', $listImageId);
                foreach ($arrImageId as $imgId) {
                    if (strlen($imgId) > 0) {
                        $this->dal_order->createImageOrder([
                            'img_order' => $newOrder->od_id,
                            'img_src' => $imgId
                        ]);
                    }
                }

                $newOrder->od_code = $this->genOrderCode($newOrder->od_id);
                $newOrder->save();
                return _ApiCode::SUCCESS;
            }
            return _ApiCode::ERROR_UNKNOWN;
        } catch (\Exception $e) {
            return _ApiCode::ERROR_UNKNOWN;
        }
    }

    public function uploadImage()
    {
        try {
            if(Input::hasFile('myPdf')){
                $file = Input::file('myPdf');
                if($file->getMimeType() == 'application/pdf'){
                    $destination = 'supplier';
                    $alias = $this->CommonUpload($destination, $file);
                    if ($alias){
                        return response()->json(Common::buildApiResponse([
                            "uploaded" => 1,
                            "alias" => $alias
                        ]));
                    }
                }
                else return response()->json(
                    array(
                        "uploaded" => 0,
                        "alias" => 0
                    )
                );
            }
            $imageInfo = getimagesize($_FILES['file']['tmp_name']);
            if ($imageInfo['mime'] == ("image/png") ||
                $imageInfo['mime'] == ("image/jpeg") ||
                $imageInfo['mime'] == ("image/gif") ||
                $imageInfo['mime'] == ("image/jpg") ||
                $imageInfo['mime'] == ("image/bmp")) {

                $file = Input::file('file');
                $destination = 'supplier';
                $alias = $this->CommonUpload($destination, $file);
                if ($alias) {
                    $this->imageCrop->MakeSupplierThumb($alias);
                    return response()->json(Common::buildApiResponse([
                        "uploaded" => 1,
                        "alias" => $alias
                    ]));
                } else return response()->json(
                    array(
                        "uploaded" => 0,
                        "alias" => 0
                    )
                );
            }
            return response()->json(
                array(
                    "uploaded" => 0,
                    "alias" => 0
                )
            );
        } catch (\Exception $e) {
            return response()->json(
                array(
                    "uploaded" => 0,
                    "alias" => 0
                )
            );
        }
    }

    public function uploadImageOrder()
    {
        $imageInfo = getimagesize($_FILES['file']['tmp_name']);
        if ($imageInfo['mime'] == ("image/png") ||
            $imageInfo['mime'] == ("image/jpeg") ||
            $imageInfo['mime'] == ("image/gif") ||
            $imageInfo['mime'] == ("image/jpg") ||
            $imageInfo['mime'] == ("image/bmp")) {

            $file = Input::file('file');
            $destination = 'order';
            $alias = $this->CommonUpload($destination, $file);
            if ($alias) {
                $this->imageCrop->MakeOrderThumb($alias);
                $imageModel = $this->dal_order->createImageOrder([
                    'img_src' => '/' . $alias,
                ]);
                return response()->json(Common::buildApiResponse([
                    "uploaded" => 1,
                    "img_id" => $imageModel->img_id,
                ]));
            } else return response()->json(
                array(
                    "uploaded" => 0,
                    "img_id" => 0
                )
            );
        }
        return response()->json(
            array(
                "uploaded" => 0,
                "img_id" => 0
            )
        );
    }

    public function genOrderCode($id)
    {
        $dateCreate = Carbon::now();
        $numSupplier = $this->dal_order->getCountByMonth($id);
        return 'DH' . $dateCreate->format('ymd') . $numSupplier;
    }

    public function updateOrder($request)
    {
        $currentOrder = Order::where('od_id', $request->odId)->first();
        if ($currentOrder && $currentOrder->od_id) {
            $dataUpdate = ($request->dataUpdate);
            foreach ($dataUpdate as $key => $value) {
                if (array_key_exists($key, $currentOrder->toArray())) {
                    $currentOrder->$key = $value;
                }
            }
            $contentOrder = unserialize($currentOrder->od_content);
            foreach ($dataUpdate as $key => $value) {
                if (array_key_exists($key, $contentOrder)) {
                    $contentOrder[$key] = $value;
                }
            }

            //update new image
            $listImageId = $request->imgId;
            if (is_array($listImageId)) $arrImageId = $listImageId;
            else $arrImageId = explode(',', $listImageId);
            foreach ($arrImageId as $imgId) {
                if ($imgId > 0) $this->dal_order->updateImageOrder($imgId, array(
                    'img_order' => $currentOrder->od_id,
                ));
            }

            //update pdf file
            if (Input::hasFile('pdf_file')) {
                $file = $file = Input::file('pdf_file');
                $destination = 'order';
                $alias = $this->CommonUpload($destination, $file);
                if ($alias) $contentOrder['file'] = $alias;
            }
            $currentOrder->od_content = serialize($contentOrder);
            $currentOrder->save();
        }
    }

    public function deleteImage($imgId)
    {
        try {
            $image = $this->dal_order->getDetailImage($imgId);
            $this->imageCrop->RemoveThumb($image->img_src);
            $this->dal_order->deleteImageOrder($imgId);
            return _ApiCode::SUCCESS;
        } catch (\Exception $e) {
            // log exception
            activity()->performedOn(User::getModel())
                ->causedBy(Auth::user())
                ->withProperties(['action' => 'deleteImage'])
                ->log("line " . $e->getLine() . " file " . $e->getFile() . "\n" . $e->getMessage());
            \Log::error($e->getMessage(), $e->getTrace());
            return _ApiCode::ERROR_UNKNOWN;
        }
    }

    public function postEditInfo($request)
    {
        try {
            $user = Auth::user();
            if ($user && $user->user_id) {
                foreach (($request->dataUpdate) as $key => $value) {
                    if (array_key_exists($key, $user->toArray())) {
                        $user->$key = $value;
                    }
                }
                //update password
                if ($request->newPassword) {
                    $bcrypt = new BcryptHasher();
                    $passwordCheck = $bcrypt->check($request->currentPassword, $user->password);
                    if ($passwordCheck) {
                        $user->password = bcrypt($request->newPassword);
                    }
                }
                $user->save();
            }
            return _ApiCode::SUCCESS;
        } catch (\Exception $e) {
            //log exception
            activity()->performedOn(User::getModel())
                ->causedBy(Auth::user())
                ->withProperties(['action' => 'postEditInfo'])
                ->log("line " . $e->getLine() . " file " . $e->getFile() . "\n" . $e->getMessage());
            \Log::error($e->getMessage(), $e->getTrace());
            return _ApiCode::ERROR_UNKNOWN;
        }
    }

    public function postaddProduct($request)
    {
        try {
            $user = Auth::user();
            $supplier = Supplier::where('sp_manager', $user->user_id)->first();
            $lst_product = $request->prdId;
            if ($supplier && $supplier->sp_id && isset($lst_product)) {
                Supply::where('sp_supply', $supplier->sp_id)->delete();
                foreach ($lst_product as $prd_id) {
                    Supply::create([
                        'sp_supply' => $supplier->sp_id,
                        'sp_product' => $prd_id
                    ]);
                }
                return _ApiCode::SUCCESS;
            }
            return _ApiCode::ERROR_UNKNOWN;
        } catch (\Exception $e) {
            //log exception
            activity()->performedOn(User::getModel())
                ->causedBy(Auth::user())
                ->withProperties(['action' => 'addProduct'])
                ->log("line " . $e->getLine() . " file " . $e->getFile() . "\n" . $e->getMessage());
            \Log::error($e->getMessage(), $e->getTrace());
            return _ApiCode::ERROR_UNKNOWN;
        }
    }

    public function getListProduct($spId)
    {
        return Supply::where('sp_supply', $spId)->pluck('sp_product');
    }

    private function countOrderBid()
    {
        $supplier = Supplier::where('sp_manager', Auth::user()->user_id)->first();
        $bid = [1];
        $lstBid = [];
        if ($supplier && $supplier->sp_id) {
            $lstBid = Order_supplier::where('sp_id', $supplier->sp_id)->whereIn('status', $bid)
                ->pluck('order_id');
        }
        return Order::whereIn('od_id', $lstBid)
            ->count();
    }
}