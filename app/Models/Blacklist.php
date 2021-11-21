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
        'name',
        'card_id',
        'image',
        'date_transfer',
        'price',
        'web'
    ];

    // public function getUser() {
    //     return $this->belongsTo(UserAccount::class, 'user_id', 'user_id');
    // }
}