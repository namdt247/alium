<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_supplier extends Model
{
    protected $table = 'order_supplier';
    protected $fillable = ['order_id', 'order_code', 'sp_id', 'status'];
    public $timestamps = true;
    protected $hidden = [];
}
