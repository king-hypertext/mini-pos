<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $with = ['products'];
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeGetCart($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeAddToCart($query, $productId, $quantity, $price, $userId)
    {
        $existingCart = $query->where('user_id', $userId)->where('product_id', $productId)->first();

        if ($existingCart) {
            $existingCart->quantity += $quantity;
            $existingCart->save();
        } else {
            $query->create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $price,
            ]);
        }
    }

    public function scopeUpdateQuantity($query, $cartId, $quantity)
    {
        $cart = $query->find($cartId);
        $cart->quantity = $quantity;
        $cart->save();
    }

    public function scopeRemoveFromCart($query, $cartId)
    {
        $query->find($cartId)->delete();
    }

    public function scopeClearCart($query, $userId) 
    {
        $query->where('user_id', $userId)->delete();
    }

  
}
