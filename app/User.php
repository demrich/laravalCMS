<?php

namespace App;
Use App\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;

    public function roles()
    {
        return $this->belongsToMany('App\Role', 'user_role', 'user_id', 'role_id');
    }

    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($role)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role)
    {
        if($this->roles()->where('name',$role)->first()) {
            return true;
        }
        return false;
    }

    protected $fillable = [
        'first_name','email','password','token'
    ];

    public function verified()
    {

        return $this->token === null;

    }

    public function sendVerificationEmail()
    {
        $user->notify(new VerifyEmail($this));

    }
}
