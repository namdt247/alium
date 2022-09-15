<?php

namespace App\Models;

use App\Helper\_ObjectType;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * App\Models\User
 */
class User extends Authenticatable implements JWTSubject
{
    use HasRoles;
    use Notifiable;

    protected $guard_name = 'web';
    protected $table = 'user';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'user_id',
        'user_name',
        'user_firstName',
        'user_lastName',
        'user_des',
        'user_email',
        'user_phone',
        'user_avatar',
        'user_address',
        'user_type',
        'user_city',
        'user_district',
        'user_role',
        'user_verified',
        'user_verifyCode',
        'user_gender',
        'user_birthday',
        'user_alias',
        'user_status',
        'password',
        'user_showName'
    ];
    public $timestamps = true;
    protected $appends = ['userDetail'];
    protected $hidden = ['password','remember_token'];

    public function supply(){
        return $this->belongsToMany('App\Models\Product','supply','sp_user','sp_product');
    }

    public function city(){
        return $this->belongsTo('App\Models\City','user_city','city_id');
    }

    public function country(){
        return $this->belongsTo('App\Models\Country','user_country','cty_id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getUserDetailAttribute() {
        return $this->hasMany('App\Models\User_detail','dt_user', 'user_id')->get();
    }

    public function assigneeTo() {
        $user_detail = $this->belongsTo('App\Models\User_detail', 'user_id', 'dt_user')
            ->where('dt_name', _ObjectType::KEY_SALE)
            ->first('dt_value');
        if ($user_detail && $user_detail->dt_value) {
            return User::where('user_id', $user_detail->dt_value)->first(['user_id', 'user_showName']);
        }
        return null;
    }
}
