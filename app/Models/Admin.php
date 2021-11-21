<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

Class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admin';
    protected $primaryKey = 'admin_id';
    protected $guard = 'admins';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'password',
        'line_id',
        'facebook',
        'tel',
        'image',
    ];
}