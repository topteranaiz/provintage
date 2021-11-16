<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Saler;

Class Blacklist extends Model
{
    protected $table = 'blacklist';
    protected $primaryKey = 'blacklist_id';
    public $timestamps = false;

    protected $fillable = [
        'saler_id',
        'detail',
        'image',
    ];

    // public function getUser() {
    //     return $this->belongsTo(UserAccount::class, 'user_id', 'user_id');
    // }
}