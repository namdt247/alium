<?php
/**
 * Created by PhpStorm.
 * User: QuanVH
 * Date: 17/02/2017
 * Time: 21:54 CH
 */

namespace App\Http\Business\Frontend;


use App\Helper\_ApiCode;
use App\Helper\Common;
use App\Helper\ImageCrop;
use App\Http\Business\Helper;
use App\Http\DAL\DAL_Article;
use App\Http\DAL\DAL_Order;
use App\Http\DAL\DAL_Product;
use App\Http\DAL\DAL_Supplier;
use App\Http\DAL\DAL_User;
use App\Models\Device_token;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\Exceptions\InvalidOptionsException;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;

class BzFrontend
{
    protected $dal_user;
    protected $dal_product;
    protected $imageCrop;
    protected $dal_order;
    protected $dal_supplier;
    protected $dal_article;
    
    public function __construct()
    {
        $this->dal_user = new DAL_User();
        $this->dal_product = new DAL_Product();
        $this->imageCrop = new ImageCrop();
        $this->dal_order = new DAL_Order();
        $this->dal_supplier = new DAL_Supplier();
        $this->dal_article = new DAL_Article();
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
            $alias = $destination . $fileName . '.' . $extension;
            if (file_exists($alias)) {
                $fileName = $fileName . "_" . $this->randomCode();
                $alias = $destination . $fileName . '.' . $extension;
            }
            if (!file_exists($destination)) {
                mkdir($destination, 0777, true);
            }

            $file->move($destination, $fileName . '.' . $extension);
            return $alias;
        }
        return '';
    }

    public function randomCode(){
        $hour = date('H');
        $minute = date('i');
        $second = date('s');
        $miliSecond = round(microtime(true) * 1000);
        $strName = $this->rand_string(3) .$hour. $this->rand_string(3) .$minute. $this->rand_string(3) .$second.
            $this->rand_string(3) .$miliSecond;
        return $strName;
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

    public function sendFCMMessage($data){
        return Helper::sendFCMMessage($data);
    }
}