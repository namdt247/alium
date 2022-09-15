<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\City
 */
class City extends Model
{
    protected $table = 'city';
    protected $primaryKey = 'city_id';

    public $timestamps = true;
    protected $hidden = [];
}
