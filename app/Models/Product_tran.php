<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Product_tran
 */
class Product_tran extends Model
{
    protected $table = 'product_tran';
    public $timestamps = false;
    public $fillable = ['prd_name','prd_alias','prd_sapo','prd_des','prd_spec'];
}
