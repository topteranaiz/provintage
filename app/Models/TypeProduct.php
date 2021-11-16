<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TypeProduct extends Model
{
    protected $table = 'tb_type_product';
    protected $primaryKey = 'type_product_id';
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];
}
