<?php

namespace App\Models;

use App\Http\DAL\DAL_Config;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Feedback
 */
class Feedback extends Model
{
    protected $table = 'feedback';
    protected $primaryKey = 'fb_id';
    protected $guarded = [];
    protected $appends = ['cate'];

    public function order(){
        return $this->belongsTo('App\Models\Order','fb_order','od_code');
    }


    public function getCateAttribute(){
        try {
            return DAL_Config::getConfigValueById(30,$this->getAttribute('fb_cate'));
        } catch (\Exception $e) {
            //log exception
            activity()->performedOn(Feedback::getModel())
                ->withProperties(['action' => 'getCateAttribute'])
                ->log("line ".$e->getLine()." file ".$e->getFile() ."\n".$e->getMessage());
            \Log::error($e->getMessage(),$e->getTrace());
            return 'Không xác định';
        }
    }
}
