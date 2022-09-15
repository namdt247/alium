<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Transaction
 */
class Transaction extends Model
{
    protected $table = 'transaction';
    protected $primaryKey = 'tran_id';
    protected $fillable = [
        'tran_id',
        'tran_number',
        'tran_type',
        'tran_port',
        'tran_order',
        'tran_target',
        'tran_amount',
        'tran_message',
        'tran_content'
    ];
    public $timestamps = true;
    protected $hidden = [];

}
