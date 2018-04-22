<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    public $fillable = ['body', 'product_id'];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function scopeOfProduct($query, $productId) {
        return $query->where('product_id', $productId);
    }
}
