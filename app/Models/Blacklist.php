<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Saler;
use App\Models\BlacklistImage;

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
        'web',
        'type_cheat'
    ];

    public function getBlacklistImage() {
        return $this->hasMany(BlacklistImage::class, 'blacklist_id', 'blacklist_id');
    }

    // public function getUser() {
    //     return $this->belongsTo(UserAccount::class, 'user_id', 'user_id');
    // }
}