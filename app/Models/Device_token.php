<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Device_token
 */
class Device_token extends Model
{
    protected $table = 'device_token';

    public $timestamps = true;
    protected $guarded = [];
    protected $hidden = [];
}
