<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\TypeProduct;
use App\Models\ProductAttachment;
use App\Models\Comment;
use App\Models\Saler;

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

    public function getSaler() {
        return $this->belongsTo(Saler::class, 'saler_id', 'saler_id');
    }

    public function getSize() {
        if($this->size == 1) {
            return "S";
        }else if($this->size == 2) {
            return "M";
        }else if($this->size == 3) {
            return "L";
        }else if($this->size == 4) {
            return "XL";
        }else {
            return "-";
        }
    }

    public function getFabric() {
        if($this->fabric_type == 1) {
            return "ผ้า Cotton 100%";
        }else if($this->fabric_type == 2) {
            return "ผ้า Cotton 50% Polyester 50%";
        }else {
            return "-";
        }
    }

    public function getYear() {
        if($this->year == 1) {
            return "1980";
        }else if($this->year == 2) {
            return "1990";
        }else if($this->year == 3) {
            return "2000";
        }else {
            return "-";
        }
    }

    public function getMadeIn() {
        if($this->made_in == 1) {
            return "U.S.A";
        }else if($this->made_in == 2) {
            return "Ecuador";
        }else if($this->made_in == 3) {
            return "Egypt";
        }else if($this->made_in == 4) {
            return "Other Europe";
        }else {
            return "-";
        }
    }

}
