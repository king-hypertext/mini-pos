<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'total',
        'customer_id',
        'payment_method_id',
        'sales_status_id',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function salesItems()
    {
        return $this->hasMany(SalesItem::class);
    }
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
    // public function paymentStatus(){

    // }
    public function scopeGetSalesByDate($query, $startDate, $endDate)
    {
        return $query->whereBetween('date', [$startDate, $endDate]);
    }
    public function scopeGetSalesByCategory($query, $categoryId)
    {
        return $query->whereHas('product', function ($q) use ($categoryId) {
            $q->where('category_id', $categoryId);
        });
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
