<?php

namespace Dartika\Adm\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdmUser extends Authenticatable
{
    use Notifiable;

    protected $table = 'admin_users';
    
    protected $fillable = [ 'email', 'password' ];

    protected $hidden = [ 'password', 'remember_token' ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
}
