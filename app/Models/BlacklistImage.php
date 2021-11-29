<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

Class BlacklistImage extends Model
{
    protected $table = 'blacklist_image';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'blacklist_id',
        'image',
    ];

    // public function getUser() {
    //     return $this->belongsTo(UserAccount::class, 'user_id', 'user_id');
    // }
}