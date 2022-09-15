<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Config
 */
class Config extends Model
{
    protected $table = 'config';
    protected $primaryKey = 'cfg_id';
    protected $fillable = [
        'cfg_id',
        'cfg_name',
        'cfg_value',
        'cfg_alias',
        'cfg_type'
    ];
    public $timestamps = true;
    protected $hidden = [];

}
