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
use App\Helper\Common;
use App\Http\DAL\DAL_Config;
use App\Models\City;
use App\Models\Country;
use App\Models\District;
use App\Models\User;
use App\Notifications\OrderChange;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;

class BzNotify extends BzApi
{
    public function getListNotify($userId){
        $filter = 0;
        if(isset($_GET['filter'])) $filter = $_GET['filter'];
        switch ($filter){
            case 1:
                $list_notify = DatabaseNotification::where('type',OrderChange::class)
                    ->orderBy('created_at','desc')
                    ->where('notifiable_type',User::class)
                    ->where('notifiable_id',$userId)
                    ->get();
                $lstNotify = [];
                foreach ($list_notify as $notify) {
                    if ($notify->data['cate'] == 1) {
                        array_push($lstNotify, $notify);
                    }
                }
                break;
            default:
                $list_notify = DatabaseNotification::where('notifiable_id', $userId)
                    ->orderBy('created_at','desc')->get();
                $lstNotify = [];
                foreach ($list_notify as $notify) {
                    if ($notify->data['cate'] == 1) {
                        array_push($lstNotify, $notify);
                    }
                }
                break;
        }
        $notifies = Auth::user()->unreadNotifications()->get();
        foreach ($notifies as $notify) {
            if ($notify->data['cate'] == 1) {
                $notify->update(['read_at' => Carbon::now()]);
            }
        }
        return $lstNotify;
    }

    public function getCountNotifySP(){
        $list_notify = Auth::user()->unreadNotifications()->get();
        $lstNotify = [];
        foreach ($list_notify as $notify) {
            if ($notify->data['cate'] == 2) {
                array_push($lstNotify, $notify);
            }
        }
        return count($lstNotify);
    }

    public function getListNotifySP($userId){
        $filter = 0;
        $readAll = '';
        if(isset($_GET['filter'])) $filter = $_GET['filter'];
        if(isset($_GET['readAll'])) $readAll = $_GET['readAll'];
        if($readAll != 'undefined' && $readAll != '') {
            $notifies = Auth::user()->unreadNotifications()->get();
            foreach ($notifies as $notify) {
                if ($notify->data['cate'] == 2) {
                    $notify->update(['read_at' => Carbon::now()]);
                }
            }
        }
        switch ($filter){
            case 1:
                $list_notify = DatabaseNotification::where('type',OrderChange::class)
                    ->orderBy('created_at','desc')
                    ->where('notifiable_type',User::class)
                    ->where('notifiable_id',$userId)
                    ->get();
                $lstNotify = [];
                foreach ($list_notify as $notify) {
                    if ($notify->data['cate'] == 2) {
                        array_push($lstNotify, $notify);
                    }
                }
                break;
            default:
                $list_notify = DatabaseNotification::where('notifiable_id', $userId)
                    ->orderBy('created_at','desc')->get();
                $lstNotify = [];
                foreach ($list_notify as $notify) {
                    if (array_key_exists('cate',$notify->data) && $notify->data['cate'] == 2) {
                        array_push($lstNotify, $notify);
                    }
                }
                break;
        }
        return $lstNotify;
    }

    public function readNotify($notifyId){
        DatabaseNotification::find($notifyId)->markAsRead();
        return _ApiCode::SUCCESS;
    }
}