<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier_detail extends Model
{
    protected $table = 'supplier_detail';
    protected $guarded = [];
    public $timestamps = true;
    protected $hidden = [];
    protected $casts = [
        'sp_detail' => 'array',
    ];
}
