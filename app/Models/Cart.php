<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $fillable = [
    'user_id',
    'product_id',
    'product_color_id', // Thêm cột này vào fillable
    'quantity',
    ];
    public function ProductColor()
    {
        return $this->belongsTo(ProductColor::class, 'product_color_id');
    }
    public function ProductSize()
    {
        return $this->hasManyThrough(ProductSize::class, ProductColor::class, 'id', 'id', 'product_id', 'product_size_id');
    }
}
