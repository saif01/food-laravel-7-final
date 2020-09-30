<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


use App\Role;
use App\Notifications\PasswordReset;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login', 'name', 'email', 'type', 'image', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];




    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordReset($token));
    }





    //Relation user to role
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    // Check Array of roles
    public function hasAnyRoles($roles)
    {
        if($this->roles()->whereIn('name',$roles)->first()){
            return true;
        }
        return false;
    }

    // Check single roles
    public function hasRole($role)
    {
        if($this->roles()->where('name',$role)->first()){
            return true;
        }
        return false;
    }


}
