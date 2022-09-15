<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Order_detail
 */
class Order_detail extends Model
{
    protected $table = 'order_detail';
    protected $primaryKey = 'od_id';
    public $timestamps = true;
    protected $guarded = [];
    protected $hidden = [];
    protected $with = ['supplier'];
    protected $appends = ['detail'];

    public function supplier(){
        return $this->belongsTo('App\Models\Supplier','od_assigneeTo','sp_id');
    }
    public function getDetailAttribute()
    {
        try {
            return unserialize($this->od_detail);
        } catch (\Exception $e) {
            return $this->od_detail;
        }
    }

    public function assignee(){
        return $this->belongsTo('App\Models\User','od_assigneeTo','user_id');
    }

}
