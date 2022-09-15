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
use App\Http\Business\API\BzUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    protected $bzUser;

    public function __construct()
    {
        parent::__construct();
        $this->bzUser = new BzUser();
    }

    public function sendVerifyCode(Request $request){
        return response()->json(Common::buildApiResponse([],$this->bzUser->sendVerifyCode($request->email)));
    }

    public function postForgetPass(Request $request){
        return response()->json(Common::buildApiResponse([],$this->bzUser->postForgetPass($request)));
    }

    public function sendRegisterCode(){
        return response()->json(Common::buildApiResponse([],$this->bzUser->sendRegisterCode()));
    }
    public function checkRegisterCode(Request $request){
        return response()->json(Common::buildApiResponse([],$this->bzUser->checkRegisterCode($request)));
    }

    public function register(Request $request){
        return response()->json(Common::buildApiResponse([],$this->bzUser->register($request)));
    }

    public function registerSocial(Request $request){
        return $this->bzUser->registerSocial($request);
    }

    public function login(Request $request){
        return $this->bzUser->login($request);
    }

    public function loginSocial(Request $request){
        return $this->bzUser->loginSocial($request);
    }

    public function logout(Request $request) {
        return $this->bzUser->logout($request);
    }

    public function postChangePass(Request $request){
        return response()->json(Common::buildApiResponse([],$this->bzUser->postChangePass($request)));
    }

    public function getUserInfo(Request $request){
        return response()->json(
            Common::buildApiResponse(["info" => $this->bzUser->getUserInfo($request)])
        );
    }

    public function postEditInfo(Request $request){
        return response()->json(
            Common::buildApiResponse([],$this->bzUser->postEditInfo($request))
        );
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @group GENERAL INFO
     * Get list Country
     * @authenticated
     * @urlParam \
     * @queryParam \
     * @response 200 {"data": [], "status": 200, "message": "Successful"}
     */
    public function getListCountry(){
        return response()->json(
            Common::buildApiResponse([
                'country' => $this->bzUser->getListCountry(),
            ])
        );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @group GENERAL INFO
     * Get list City
     * @authenticated
     * @urlParam country ID
     * @queryParam \
     * @response 200 {"data": [], "status": 200, "message": "Successful"}
     */
    public function getListCity($ctyId){
        return response()->json(
            Common::buildApiResponse([
                'city' => $this->bzUser->getListCity($ctyId),
            ])
        );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @group GENERAL INFO
     * Get list distrist
     * @authenticated
     * @urlParam city ID
     * @queryParam \
     * @response 200 {"data": [], "status": 200, "message": "Successful"}
     */
    public function getListDistrict($cityId){
        return response()->json(
            Common::buildApiResponse([
                'district' => $this->bzUser->getListDistrict($cityId),
            ])
        );
    }

    public function getListCountrySupplier(){
        return response()->json(
            Common::buildApiResponse([
                'country' => $this->bzUser->getListCountrySupplier(),
            ])
        );
    }

    public function getListCitySupplier(){
        $country = isset($_GET['country']) ? $_GET['country'] : 245;
        return response()->json(
            Common::buildApiResponse([
                'city' => $this->bzUser->getListCitySupplier($country),
            ])
        );
    }
}