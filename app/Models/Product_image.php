<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Product_image
 */
class Product_image extends Model
{
    protected $table = 'product_image';
    protected $primaryKey = 'img_id';
    protected $fillable = [
        'img_id',
        'img_product',
        'img_src',
        'img_name',
        'img_alis',
        'img_status',
        'img_shape'
    ];
    public $timestamps = true;
    protected $hidden = [];

}
