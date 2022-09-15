<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_status extends Model
{
    protected $table = 'order_status';
    protected $primaryKey = 'stt_id';
    public $timestamps = true;
    protected $guarded = [];

    public function sub_status(){
        return $this->hasMany('App\Models\Order_status','stt_parent','stt_id')
            ->select(['stt_id','stt_valueF','stt_nameAction','stt_parent']);
    }

    public function parent_status(){
        return $this->belongsTo('App\Models\Order_status','stt_parent','stt_id');
    }
}
