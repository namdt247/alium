<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Order_image
 */
class Order_image extends Model
{
    protected $table = 'order_image';
    protected $primaryKey = 'img_id';
    public $timestamps = true;
    protected $guarded = [];
}
