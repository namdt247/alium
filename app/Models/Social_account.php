<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Social_account
 */
class Social_account extends Model
{
    protected $table = 'social_account';
    protected $fillable = [
        'acc_id',
        'acc_user',
        'acc_providerId',
        'acc_provider',
        'acc_token',
        'acc_status'
    ];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\Models\User','acc_user','user_id');
    }
}
