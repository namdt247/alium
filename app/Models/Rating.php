<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = 'rating';
    protected $primaryKey = 'rate_id';
    protected $guarded = [];
    public $timestamps = true;
    protected $hidden = [];
    protected $with = ['user','order'];
    protected $appends = ['supplier','date'];

    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'rate_targetId', 'od_id');
    }


    public function user(){
        return $this->belongsTo('App\Models\User','rate_authorId','user_id')
            ->select(['user_id','user_showName','user_city','user_avatar']);
    }

    public function getSupplierAttribute(){
        $order = $this->order()->first();
        if ($order && $order->od_id)
            return $order->od_assigneeTo ? Supplier::where('sp_id',$order->od_assigneeTo)
                ->first(['sp_id','sp_name','sp_code']) : ['sp_name' => 'Không xác định','sp_code' => 0];
        return null;
    }

    public function getDateAttribute(){
        try {
            $dt = Carbon::parse($this->getAttribute('created_at'));
            return $dt->day.'/'.$dt->month.'/'.$dt->year;
        }
        catch (\Exception $e) {
            $dt = Carbon::now();
            return $dt->day.'/'.$dt->month.'/'.$dt->year;
        }

    }
}
