<?php

namespace App\Models;

use App\Helper\Common;
use App\Http\DAL\DAL_Config;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\Supplier
 */
class Supplier extends Model
{
    use Notifiable;
    protected $table = 'supplier';
    protected $primaryKey = 'sp_id';
    protected $guarded = [];
    public $timestamps = true;
    protected $hidden = [];
    protected $with = ['city'];
    protected $appends = ['typeSupplier','qualityOrder','image'];

    public function sp_detail(){
        return $this->hasMany('App\Models\Supplier_detail','sp_supplier','sp_id');
    }
    public function product(){
        return $this->belongsToMany('App\Models\Product','supply',
            'sp_supply','sp_product');
    }

    public function city(){
        return $this->belongsTo('App\Models\City','sp_city')
            ->withDefault(['city_name' => 'Không xác định']);
    }

    public function getTypeSupplierAttribute(){
        try {
            return DAL_Config::getConfigValueById(4,$this->getAttribute('sp_type'));
        } catch (\Exception $e) {
            //log exception
            activity()->performedOn(Supplier::getModel())
                ->withProperties(['action' => 'getTypeSupplierAttribute'])
                ->log("line ".$e->getLine()." file ".$e->getFile() ."\n".$e->getMessage());
            \Log::error($e->getMessage(),$e->getTrace());
            return 'Không xác định';
        }
    }

    public function getImageAttribute(){
        return Common::buildTagArray($this->getAttribute('sp_image'));
    }

    public function getQualityOrderAttribute(){
        try {
            return DAL_Config::getConfigValueById(3,$this->getAttribute('sp_qualityOrder'));
        } catch (\Exception $e) {
            //log exception
            activity()->performedOn(Supplier::getModel())
                ->withProperties(['action' => 'getQualityOrderAttribute'])
                ->log("line ".$e->getLine()." file ".$e->getFile() ."\n".$e->getMessage());
            \Log::error($e->getMessage(),$e->getTrace());
            return 'Không xác định';
        }
    }

    public function otherProduct(){
        return $this->product()->where('prd_cate',2);
    }
}
