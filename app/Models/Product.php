<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Product
 */
class Product extends Model
{
    use Translatable;
    protected $table = 'product';
    protected $primaryKey = 'prd_id';
    protected $guarded = [];
    public $timestamps = true;
    protected $hidden = [];
    protected $with = ['image'];
    public $translatedAttributes = ['prd_name','prd_alias','prd_sapo','prd_des','prd_spec'];

    public function cate_product(){
        return $this->belongsTo('App\Models\Cate_product','prd_cate');
    }

    public function author(){
        return $this->belongsTo('App\Models\User','prd_createdBy');
    }

    public function tags(){
        return $this->morphToMany('App\Models\Tag','tga','taggable','tga_id','tga_tag');
    }

    public function getId()
    {
        return $this->getAttribute('prd_id');
    }

    public function image(){
        return $this->hasMany('App\Models\Product_image', 'img_product');
    }

}
