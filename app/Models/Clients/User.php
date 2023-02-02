<?php

namespace App\Models\Clients;

use App\Enums\Clients\GenderTypes;
use App\Enums\Clients\UserTypes;
use App\Models\Property\Property;
use App\traits\ModelTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable,HasApiTokens,ModelTrait;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password','username','first_name','last_name','phone','birthday','user_type','gender','suspended_at',
        'profile_picture',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','updated_at'
    ];

    protected $dates = ['suspended_at'];

    protected $enumCasts =
        [
            'gender' => GenderTypes::class,
            'user_type' => UserTypes::class,
        ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($password)
    {
        return  $this->attributes['password'] = Hash::make($password);
    }

    public function setUserNameAttribute($value)
    {
        $this->attributes['username'] = $this->generateUserName($value);
    }

    public function properties()
    {
        return $this->hasMany(Property::class)
            ->with(['area' => function($area)
            {
                $area->join('cities','cities.id','=','areas.city_id')
                ->join('countries','countries.id','=','cities.country_id')
                ->select('areas.*','cities.id as city_id','cities.name as city_name','countries.id as country_id',
                    'countries.name as country_name');
            }]);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class)
            ->with('property');
    }

    public function login($credential)
    {
        $user= null;
        if(Auth::attempt($credential))
        {
            $user=Auth::user();
            $user->token_api=$user->createToken('dallal')->accessToken;
        }
        return $user;
    }

    private function getAllUserSameName($name)
    {
        return User::whereRaw("username REGEXP '^{$name}(_[0-9]*)?$'")->get();
    }

    public function generateUserName($name)
    {
        $username=str_replace(' ','_',$name);
        $userRows  = $this->getAllUserSameName($username);
        $countUser = count($userRows) + 1;
        return ($countUser > 1) ? "{$username}_{$countUser}" : $username;
    }
}
