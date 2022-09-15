<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Cate_product_tran
 */
class Cate_product_tran extends Model
{
    protected $table = 'cate_product_tran';
    public $timestamps = false;
    public $fillable = ['cate_value','cate_alias'];
}
