<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Payment
 */
class Payment extends Model
{
    protected $table = 'payment';
    protected $primaryKey = 'pay_id';
    public $timestamps = true;
    protected $hidden = [];
}
