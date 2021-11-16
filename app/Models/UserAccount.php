<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class UserAccount extends Authenticatable
{
    use Notifiable;

    protected $table = 'useraccount';
    protected $primaryKey = 'user_id';
    protected $guard = 'members';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'created_at',
        'updated_at'
    ];
}
