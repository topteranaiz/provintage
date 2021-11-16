<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Blacklist;

class Saler extends Authenticatable
{
    use Notifiable;

    protected $table = 'saler';
    protected $primaryKey = 'saler_id';
    protected $guard = 'shops';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'card_id',
        'line_id',
        'created_at',
        'updated_at'
    ];

    public function getBlacklist() {
        return $this->hasMany(Blacklist::class, 'saler_id', 'saler_id');
    }
}
