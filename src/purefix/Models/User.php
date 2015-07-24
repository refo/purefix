<?php

namespace Purefix\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    // ===================================================
    // ELOQUENT ATTRIBUTES
    // ===================================================

    protected $table      = 'users';
    protected $attributes = [];
    protected $fillable   = ['name', 'email', 'password'];
    protected $appends    = [];
    protected $hidden     = ['password', 'remember_token'];

    public $timestamps    = false;


    // ===================================================
    // RELATIONSHIPS
    // ===================================================

    public function orders()
    {
        return $this->hasMany('Order');
    }
}
