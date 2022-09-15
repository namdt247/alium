<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\District
 */
class District extends Model
{
    protected $table = 'district';
    protected $primaryKey = 'dt_id';
    protected $guarded = [];
    public $timestamps = true;
    protected $hidden = [];
}
