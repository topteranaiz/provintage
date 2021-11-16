<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\TypeProduct;
use App\Models\ProductAttachment;
use App\Models\Comment;

class Product extends Model
{
    protected $table = 'tb_product';
    protected $primaryKey = 'product_id';
    public $timestamps = false;

    protected $fillable = [
        'type_product_id',
        'name',
        'size',
        'fabric_type',
        'detail',
        'amount',
        'price',
        'saler_id',
        'created_at',
        'updated_at',
        'year',
        'made_in'
    ];

    public function getTypeProduct() {
        return $this->belongsTo(TypeProduct::class, 'type_product_id', 'type_product_id');
    }

    public function getProductAttachment() {
        return $this->hasMany(ProductAttachment::class, 'product_id', 'product_id');
    }

    public function getComment() {
        return $this->hasMany(Comment::class, 'product_id', 'product_id');
    }

}
