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
use App\Helper\ImageCrop;
use App\Http\Business\Helper;
use App\Http\DAL\DAL_Article;
use App\Http\DAL\DAL_Config;
use App\Http\DAL\DAL_Order;
use App\Http\DAL\DAL_Product;
use App\Http\DAL\DAL_Rate;
use App\Http\DAL\DAL_Supplier;
use App\Http\DAL\DAL_User;
use App\Models\Config;
use App\Models\Device_token;
use App\Models\Tag;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\Exceptions\InvalidOptionsException;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use TomLingham\Searchy\Facades\Searchy;

class BzAdmin
{
    protected $dal_user;
    protected $dal_product;
    protected $dal_article;
    protected $imageCrop;
    protected $dal_supplier;
    protected $dal_order;
    protected $dal_rate;
    
    public function __construct()
    {
        $this->dal_user = new DAL_User();
        $this->dal_product = new DAL_Product();
        $this->dal_article = new DAL_Article();
        $this->dal_supplier = new DAL_Supplier();
        $this->dal_order = new DAL_Order();
        $this->imageCrop = new ImageCrop();
        $this->dal_rate = new DAL_Rate();
    }

    public function postUploadImage($destination = 'images'){
        $imageInfo = getimagesize( $_FILES['upload']['tmp_name'] );
        if ( $imageInfo['mime'] == ( "image/png" ) ||
            $imageInfo['mime'] == ( "image/jpeg" ) ||
            $imageInfo['mime'] == ( "image/gif" ) ||
            $imageInfo['mime'] == ( "image/jpg" ) ||
            $imageInfo['mime'] == ( "image/bmp" ) ) {

            $file = Input::file('upload');
            $alias = $this->CommonUpload($destination, $file);
            if($alias && $alias != ''){
                return response()->json(
                    array(
                        "uploaded" => 1,
                        "fileName" => "Ảnh bài viết",
                        "url" => '/storage/'.$alias
                    )
                );
            }
            else{
                return response()->json(
                    array(
                        "uploaded" => 0,
                        "fileName" => "Ảnh mẫu",
                        "url" => "",
                        "error" => array(
                            "message" => "upload ảnh không thành công"
                        )
                    )
                );
            }
        }
    }

    public function CommonUpload($path, $file, $name = ''){
        if($file) {
            $destination = $path;
            $extension = $file->getClientOriginalExtension();
            if ($name == '') {
                $extension_pos = strrpos($file->getClientOriginalName(), '.');
                $fileName = substr($file->getClientOriginalName(), 0, $extension_pos);
                $fileName = Common::createSlug($fileName);
            } else
                $fileName = Common::createSlug($name);
            $alias = $destination. '/' .$fileName . '.' . $extension;
            if (Storage::exists($alias)) {
                $fileName = $fileName . "_" . $this->randomCode(9);
            }
            if (!Storage::exists($destination))
                Storage::makeDirectory($destination);
            $storagePath = Storage::putFileAs(
                $destination, $file, $fileName . '.' . $extension
            );
            return $storagePath;
        }
        return '';
    }

    public function randomCode($num){
        $hour = date('H');
        $minute = date('i');
        $second = date('s');
        $miliSecond = round(microtime(true) * 1000);
        $strName = $this->rand_string(3) .$hour. $this->rand_string(3) .$minute. $this->rand_string(3) .$second.
            $this->rand_string(3) .$miliSecond;
        return substr($strName,-1*$num);
    }

    function rand_string( $length ) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = '';
        $size = strlen( $chars );
        for( $i = 0; $i < $length; $i++ ) {
            $str .= $chars[ rand( 0, $size - 1 ) ];
        }
        return $str;
    }

    public function getBaseNameFromAlias($alias){
        $arr = explode('/',$alias);
        return $arr[count($arr) - 1 ];
    }

    public function GetImageFromContent($html = null){
        $pattern = '#<img\s+[^>]*src="([^"]*)"[^>]*>#isu';
        preg_match($pattern, $html, $matches);
        if (isset($matches) && isset($matches[1]) && !empty($matches[1])) {
            return $matches[1];
        }
        return '';
    }

    public function getAllTag(){
        $result = array();
        if(isset($_GET['q'])) {
            $search = trim(mb_strtolower($_GET['q']));
            $lstTag = Searchy::search('tag')->fields('tag_normalized')->query($search)->get();
        }
        else
            $lstTag = Tag::all();
        foreach ($lstTag as $tag){
            array_push($result,['id'=>$tag->tag_name,'text'=>$tag->tag_name]);
        }
        return $result;
    }

    public function getListTagData(){
        $columns = array(
            0 => 'tag_id',
            1 => 'tag_name',
            2 => 'tag_id',
            3 => 'tag_id',
        );
        $number = $_GET['length'];
        $start = $_GET['start'];
        $search = $_GET['search']['value'];
        $page = round($start/$number)+1;
        Common::SetCurrentPage($page);
        if($search != ''){
            $lstTag = Searchy::search('tag')->fields('tag_name')
                ->query($search)->get();
            foreach ($lstTag as $tag){
                $tag->articles = Tag::find($tag->tag_id)->articles;
            }
            return [
                'data' => $lstTag,
                'total' => 10
            ];

        }
        else{
            return Tag::orderBy('created_at', 'desc')->with('articles')->paginate($number);
        }
    }

    public function postAddTag($request) {
        try {
            Tag::createTag($request->txtTag);
            $file = Input::file('tagfile');
            if ($file) {
                $strTag = file_get_contents($file);
                Tag::createTag($strTag);
            }
            return _ApiCode::SUCCESS;
        } catch (\Exception $e) {
            //log exception
            activity()->performedOn(Tag::getModel())
                ->causedBy(\Auth::user())
                ->withProperties(['action' => 'postAddTag'])
                ->log("line ".$e->getLine()." file ".$e->getFile() ."\n".$e->getMessage());
            \Log::error($e->getMessage(),$e->getTrace());
            return _ApiCode::ERROR_UNKNOWN;
        }
    }

    public function getListCity($ctyId){
        $lstCity = $this->dal_user->getListCity($ctyId);
        $result = array();
        foreach ($lstCity as $city){
            array_push($result,['id'=>$city->city_id,'text'=>$city->city_name]);
        }
        return $result;
    }

    public function getListDistrict($cityId){
        $lstDistrict = $this->dal_user->getListDistrict($cityId);
        $result = array();
        foreach ($lstDistrict as $district){
            array_push($result,['id'=>$district->dt_id,'text'=>$district->dt_name]);
        }
        return $result;
    }

    public function getDetailConfig($cfgId){
        return DAL_Config::getConfig($cfgId);
    }

    public function postEditStaticPage($request){
        try {
            $cfgId  = $request->lbId;
            $cfgValue = DAL_Config::getConfigByLocale($cfgId);
            $cfgValueLocale = array_shift($cfgValue);
            $cfgValueLocale['name'] = $request->txtContent;
            DAL_Config::updateConfigByLocale($cfgId,[$cfgValueLocale]);

            return _ApiCode::SUCCESS;
        } catch (\Exception $e) {
            return _ApiCode::ERROR_UNKNOWN;
        }
    }

    public function postEditConfigLocale($request){
        try {
            $cfgId = $request->lbId;
            $cfgValueLocale = DAL_Config::getConfigByLocale($cfgId);

            $newValueLocale = array();
            foreach ($cfgValueLocale as $cfgItem) {
                $requestField = 'txtContent' . $cfgItem['id'];
                $cfgItem['name'] = $request->$requestField;
                array_push($newValueLocale, $cfgItem);
            }
            DAL_Config::updateConfigByLocale($cfgId,$newValueLocale);

            return _ApiCode::SUCCESS;
        } catch (\Exception $e) {
            //log exception
            activity()->performedOn(Config::getModel())
                ->causedBy(\Auth::user())
                ->withProperties(['action' => 'postEditConfigLocale'])
                ->log("line ".$e->getLine()." file ".$e->getFile() ."\n".$e->getMessage());
            \Log::error($e->getMessage(),$e->getTrace());
            return _ApiCode::ERROR_UNKNOWN;
        }
    }

    public function postEditConfig($request){
        try {
            $cfgId = $request->lbId;
            $lstLocale = ['vi', 'en'];

            foreach ($lstLocale as $locale) {
                $cfgValueLocale = DAL_Config::getConfigByLocale($cfgId, $locale);
                $newValueLocale = array();
                //update value
                foreach ($cfgValueLocale as $cfgItem) {
                    $requestField = 'txtName' . $locale . $cfgItem['id'];
                    $cfgItem['name'] = $request->$requestField;

                    $requestField = 'txtTitle' . $locale . $cfgItem['id'];
                    $cfgItem['title'] = $request->$requestField;

                    $requestField = 'txtIcon' . $locale . $cfgItem['id'];
                    $cfgItem['icon'] = $request->$requestField;

                    array_push($newValueLocale, $cfgItem);
                }

                //update priority
                $sortedValueLocale = array();
                $localeField = 'lbOrder'.$locale;
                $lbOrder = $request->$localeField;
                if ($lbOrder){
                    $lstOrder = Common::buildTagArray($lbOrder);
                    foreach ($lstOrder as $order){
                        foreach ($newValueLocale as $key=>$cfgItem){
                            if (intval($cfgItem['id']) == intval($order)){
                                array_push($sortedValueLocale, $cfgItem);
                                break;
                            }
                        }
                    }
                }
                else $sortedValueLocale = $newValueLocale;

                DAL_Config::updateConfigByLocale($cfgId, $sortedValueLocale, $locale);
            }

            return _ApiCode::SUCCESS;
        } catch (\Exception $e) {
            //log exception
            activity()->performedOn(Config::getModel())
                ->causedBy(\Auth::user())
                ->withProperties(['action' => 'postEditConfig'])
                ->log("line ".$e->getLine()." file ".$e->getFile() ."\n".$e->getMessage());
            \Log::error($e->getMessage(),$e->getTrace());
            return _ApiCode::ERROR_UNKNOWN;
        }
    }

    public function postAddConfigItem($request){

        try {
            $cfgId = $request->id;
            $locale = $request->locale;
            $cfgValueLocale = DAL_Config::getConfigByLocale($cfgId, $locale);
            $newId = count($cfgValueLocale) + 1;
            array_push($cfgValueLocale, [
                'id' => $newId,
                'icon' => $request->icon,
                'title' => $request->title,
                'name' => $request->name,
            ]);
            DAL_Config::updateConfigByLocale($cfgId, $cfgValueLocale, $locale);
            return _ApiCode::SUCCESS;
        } catch (\Exception $e) {
            //log exception
            activity()->performedOn(Config::getModel())
                ->causedBy(\Auth::user())
                ->withProperties(['action' => 'postAddConfigItem'])
                ->log("line ".$e->getLine()." file ".$e->getFile() ."\n".$e->getMessage());
            \Log::error($e->getMessage(),$e->getTrace());
            return _ApiCode::ERROR_UNKNOWN;
        }
    }

    public function postDeleteConfigItem($request){

        try {
            $cfgId = $request->id;
            $locale = $request->locale;
            $itemId = intval($request->itemId);
            $cfgValueLocale = DAL_Config::getConfigByLocale($cfgId, $locale);
            $newValueLocale = array();
            foreach ($cfgValueLocale as $cfgItem) {
                if ($cfgItem['id'] != $itemId)
                    array_push($newValueLocale, $cfgItem);
            }
            DAL_Config::updateConfigByLocale($cfgId, $newValueLocale, $locale);
            return _ApiCode::SUCCESS;
        } catch (\Exception $e) {
            //log exception
            activity()->performedOn(Config::getModel())
                ->causedBy(\Auth::user())
                ->withProperties(['action' => 'postDeleteConfigItem'])
                ->log("line ".$e->getLine()." file ".$e->getFile() ."\n".$e->getMessage());
            \Log::error($e->getMessage(),$e->getTrace());
            return _ApiCode::ERROR_UNKNOWN;
        }
    }

    public function sendFCMMessage($data){
        return Helper::sendFCMMessage($data);
    }
}