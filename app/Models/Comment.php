<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserAccount;

Class Comment extends Model
{
    protected $table = 'tb_comment';
    protected $primaryKey = 'comment_id';
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'user_id',
        'comment',
        'created_at',
    ];

    public function getUser() {
        return $this->belongsTo(UserAccount::class, 'user_id', 'user_id');
    }
}