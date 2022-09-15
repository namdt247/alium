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
use App\Models\Order;
use App\Models\Rating;
use App\Models\User;
use App\Http\DAL\DAL_Config;
use Illuminate\Support\Facades\Input;
use TomLingham\Searchy\Facades\Searchy;

class BzRate extends BzAdmin
{
    public function getListRateData(){
        $number = $_GET['length'];
        $search = $_GET['search']['value'];
        $start = $_GET['start'];
        $page = round($start/$number)+1;

        Common::SetCurrentPage($page);
        if($search != ''){
            $lstRate = Searchy::search('rating')->fields('rate_authorId')->query($search)->get();
            $lstRate = array_column($lstRate->toArray(),'rate_id');

            //search by order code and supplier code
            $lstOrder = Searchy::search('order')->fields('od_code')->query($search)
                ->select('od_id','od_code')->getQuery()->limit(100)->get();
            $lstSupplier = Searchy::search('supplier')->fields('sp_code')
                ->select('sp_id','sp_code')->query($search)->getQuery()->limit(100)->get();
            $lstSupplier = array_column($lstSupplier->toArray(),'sp_id');

            $lstOrder = array_unique(array_merge(Order::whereIn('od_assigneeTo',$lstSupplier)->pluck('od_id')->toArray(),
                array_column($lstOrder->toArray(),'od_id')));

            $result = Rating::where('rate_targetType',Order::class)->whereIn('rate_id',$lstRate)
                ->orWhereIn('rate_targetId',$lstOrder)->get();
            return [
                'data' => $result,
                'total' => count($result)
            ];
        }
        else{
            return Rating::orderBy('created_at','desc')->paginate($number);
        }
    }

    public function getDetailRate($rateId){
        return $this->dal_rate->getDetailRate($rateId);
    }

    public function postAddRate($request){
        try {
            $file = Input::file('sltAvatar');
            if ($file) {
                $alias = $this->CommonUpload(DAL_Config::IMAGE_ALIAS_USER, $file);
                if ($alias) {
                    $this->imageCrop->MakeUserThumb($alias);
                }
            }
            $user = User::create([
                'user_showName' => $request->sltUserName,
                'user_city' => 0,
                'user_type' => DAL_Config::TYPE_USER_REGISTER,
                'user_role' => DAL_Config::ROLE_USER_NORMAL,
                'user_status' => DAL_Config::USER_STATUS_PENDING,
                'user_verify' => 0,
                'user_alias' => Common::CreateSlug($request->sltUserName),
                'user_verifyCode' => Common::getUserVerifyCode(),
                'user_avatar' => $alias
            ]);
            $data = [
                'rate_star' => $request->rating,
                'rate_content' => $request->txtContent,
                'rate_targetId' => $request->sltOrder,
                'rate_authorId' => $user->user_id,
                'rate_status' => $request->sltStatus,
            ];
            $this->dal_rate->createOrderRate($data);
            return _ApiCode::SUCCESS;
        } catch (\Exception $e) {
            //log exception
            activity()->performedOn(Order::getModel())
                ->causedBy(\Auth::user())
                ->withProperties(['action' => 'postAddRate'])
                ->log("line ".$e->getLine()." file ".$e->getFile() ."\n".$e->getMessage());
            \Log::error($e->getMessage(),$e->getTrace());
            return _ApiCode::ERROR_UNKNOWN;
        }
    }

    public function postEditRate($request) {
        try {
            if ($request->sltAvatar && $request->txtName) {
                $file = Input::file('sltAvatar');
                $alias = $this->CommonUpload(DAL_Config::IMAGE_ALIAS_USER, $file);
                if ($alias) {
                    $this->imageCrop->MakeUserThumb($alias);
                }
                $user = User::create([
                    'user_showName' => $request->txtName,
                    'user_city' => 0,
                    'user_type' => DAL_Config::TYPE_USER_REGISTER,
                    'user_role' => DAL_Config::ROLE_USER_NORMAL,
                    'user_status' => DAL_Config::USER_STATUS_PENDING,
                    'user_verify' => 0,
                    'user_alias' => Common::CreateSlug($request->txtName),
                    'user_verifyCode' => Common::getUserVerifyCode(),
                    'user_avatar' => $alias
                ]);
                $rateId = $request->lbId;
                $rate = $this->dal_rate->getDetailRate($rateId);
                $rate->rate_authorId = $user->user_id;
                $rate->rate_status = $request->sltStatus;
                $rate->rate_content = $request->txtContent;
                $rate->save();
                return _ApiCode::SUCCESS;
            }elseif ($request->sltAvatar || $request->txtName) {
                return _ApiCode::ERROR_UNKNOWN;
            }else {
                $rateId = $request->lbId;
                $rate = $this->dal_rate->getDetailRate($rateId);
                $rate->rate_status = $request->sltStatus;
                $rate->rate_content = $request->txtContent;
                $rate->save();
                return _ApiCode::SUCCESS;
            }
        } catch (\Exception $e) {
            // log exception
            return _ApiCode::ERROR_UNKNOWN;
        }
    }
}