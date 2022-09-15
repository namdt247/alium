<?php
/**
 * Created by PhpStorm.
 * User: QuanVH
 * Date: 17/02/2017
 * Time: 21:45 CH
 */

namespace App\Http\Controllers\Api;


use App\Helper\_ApiCode;
use App\Helper\_ApiMessage;
use App\Helper\Common;
use App\Http\Business\API\BzNotify;
use App\Http\Business\API\BzUser;
use App\Http\Controllers\Controller;
use App\Http\DAL\DAL_Config;
use App\Models\City;
use App\Models\Country;
use App\Models\District;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class NotifyController extends Controller
{
    protected $bzNotify;

    public function __construct()
    {
        parent::__construct();
        $this->bzNotify = new BzNotify();
    }

    /**
     * @param $imgId
     * @return \Illuminate\Http\JsonResponse
     * @group NOTIFICATION
     * Get list Nofification demander
     * @authenticated
     * @urlParam \
     * @queryParam \
     * @response 200 {"data": [], "status": 200, "message": "Success"}
     */
    public function getListNotify()
    {
        return response()->json(Common::buildApiResponse([
            'notify' => $this->bzNotify->getListNotify(Auth::user()->user_id),
        ], _ApiCode::SUCCESS, _ApiMessage::SUCCESS));
    }

    /**
     * @param $imgId
     * @return \Illuminate\Http\JsonResponse
     * @group NOTIFICATION
     * Get list Nofification supplier
     * @authenticated
     * @urlParam \
     * @queryParam \
     * @response 200 {"data": [], "status": 200, "message": "Success"}
     */
    public function getListNotifySP()
    {
        return response()->json(Common::buildApiResponse([
            'notify' => $this->bzNotify->getListNotifySP(Auth::user()->user_id),
        ], _ApiCode::SUCCESS, _ApiMessage::SUCCESS));
    }

    /**
     * @param $imgId
     * @return \Illuminate\Http\JsonResponse
     * @group NOTIFICATION
     * Read notification
     * @authenticated
     * @urlParam \
     * @queryParam \
     * @response 200 {"data": [], "status": 200, "message": "Success"}
     */
    public function readNotify($notifyId)
    {
        return response()->json(Common::buildApiResponse([], $this->bzNotify->readNotify($notifyId)));
    }

    public function getCountNotifySP(){
        return response()->json(Common::buildApiResponse($this->bzNotify->getCountNotifySP()));
    }
}