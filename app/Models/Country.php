<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Country
 */
class Country extends Model
{
    protected $table = 'country';
    protected $primaryKey = 'cty_id';

    public $timestamps = true;
    protected $hidden = [];
}
