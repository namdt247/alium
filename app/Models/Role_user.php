<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Role_user
 */
class Role_user extends Model
{
    protected $table = 'role_user';
    protected $primaryKey = 'role_id';
    protected $fillable = [
        'role_id',
        'role_name',
        'role_des',
        'role_type',
        'role_status'
    ];
    public $timestamps = true;
    protected $hidden = [];

    public function user(){
        return $this->hasMany('App\Models\User','user_role');
    }

}
