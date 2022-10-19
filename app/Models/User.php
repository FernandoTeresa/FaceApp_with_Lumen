<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;

use Illuminate\Support\ServiceProvider;

class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable, HasFactory;

    protected $fillable=[
        'username','password', 'first_name', 'last_name','email'
    ];
    

    protected $hidden = [
        'password',
    ];



    // protected static function boot()
    // {
    //     parent::boot();
    
    //     self::creating(function($model){
    //         $model->password = Hash::make($model->password);
    //     });

    // }

    public function save(array $options = [])
    {
        if(isset($options['password']))
        {
            $this->password = Hash::make($options['password']);
        }
        if(!parent::save($options)){
            return false;
        }
        return true;
    }



    // public function save($options=[])
    // {
    //     //make the hash from the options argument who cames by the body of the request
    //     $this->password = Hash::make($options['raw_password']);

    //     return parent::save($options);
    // }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'id_user')->with('comments');
    }




}
