<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ProductAttachment extends Model
{
    protected $table = 'tb_product_attachment';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'filename',
        'path',
    ];
}
