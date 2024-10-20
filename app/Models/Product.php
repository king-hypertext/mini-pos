<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $with = ['brand', 'category', 'status'];
    protected $fillable = [
        'name',
        'description',
        'market_price',
        'price',
        'expiry_date',
        'image',
        'quantity',
        'product_status_id',
        'brand_id',
        'category_id',
    ];
    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
    public function sale()
    {
        return $this->hasMany(Sale::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function status()
    {
        return $this->belongsTo(ProductStatus::class, 'product_status_id', 'id');
    }
    public function salesItems()
    {
        return $this->hasMany(SalesItem::class);
    }
}
