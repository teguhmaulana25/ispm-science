<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'name', 'username', 'email', 'password', 'status', 'email_verified_at', 'created_by', 'updated_by'
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

    /** VALIDATE **/
    public static $rules = [
        'name' => 'required|max:191',
        'username' => 'required|max:140|unique:users,username',
        'email' => 'required|email|max:140',
        'password' => 'required|min:5|confirmed',
        'password_confirmation' => 'required|required_with:password',
        'status' => 'required'
    ];

    public static function rule_edit($id)
    {
        return [
            'name' => 'required|max:191',
            'username' => 'required|max:140|unique:users,username,' . $id
        ];
    }

    public static function rule_edit_auth($id)
    {
        return [
            'name' => 'required|max:191',
            'email' => 'required|email|max:140',
        ];
    }
}
