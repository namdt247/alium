<?php

namespace App\Models;

use App\Http\DAL\DAL_Config;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cate_product
 */

class Cate_product extends Model
{
    use Translatable;
    protected $table = 'cate_product';
    protected $primaryKey = 'cate_id';
    protected $fillable = [
        'cate_id',
        'cate_name',
        'cate_value',
        'cate_featureImg',
        'cate_parent',
        'cate_alias',
        'cate_status'
    ];
    public $timestamps = true;
    protected $hidden = [];
    public $translatedAttributes = ['cate_value', 'cate_alias'];

    public function sub_cate(){
        return $this->hasMany('App\Models\Cate_product','cate_parent','cate_id');
    }

    public function parent_cate(){
        return $this->belongsTo('App\Models\Cate_product','cate_parent','cate_id');
    }
    public function product(){
        return $this->hasMany('App\Models\Product','prd_cate','cate_id')
            ->where('prd_status','!=',DAL_Config::STATUS_DELETED)->orderBy('prd_order');
    }
}
