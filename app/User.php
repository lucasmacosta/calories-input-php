<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role'
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
     * The list of valid roles for users
     *
     * @var array
     */
    private static $available_roles = [
        'user' => 'User',
        'usersManager' => 'Users Manager',
        'admin' => 'Admin',
    ];

    /**
     * Returns the list of valid roles for users
     *
     * @return array
     */
    public static function getRolesList() {
        return self::$available_roles;
    }

    /**
     * Returns the readable name of the role
     *
     * @return string
     */
    public function roleName() {
        return self::$available_roles[$this->role];
    }

    /**
     * Get the settings record associated with the user.
     */
    public function settings()
    {
        return $this->hasOne('App\Settings');
    }
}
