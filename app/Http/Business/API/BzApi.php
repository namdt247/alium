<?php
/**
 * Created by PhpStorm.
 * Project: Alium_main
 * User: quanvu
 * Date: 13/07/2019
 */


namespace App\Http\Business\API;


use App\Helper\Common;
use App\Helper\ImageCrop;
use App\Http\DAL\DAL_Order;
use App\Http\DAL\DAL_Product;
use App\Http\DAL\DAL_User;
use Illuminate\Support\Facades\Storage;

class BzApi
{
    protected $dal_user;
    protected $dal_product;
    protected $dal_order;
    protected $imageCrop;
    public function __construct()
    {
        $this->dal_user = new DAL_User();
        $this->dal_product = new DAL_Product();
        $this->dal_order = new DAL_Order();
        $this->imageCrop = new ImageCrop();
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
        $strName = $this->rand_string(3) .$hour. $this->rand_string(3)
            .$minute. $this->rand_string(3) .$second.
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



}