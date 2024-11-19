<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnSale extends Model
{
    use HasFactory;
    protected $fillable = [
        'sale_number',
        'customer_id',
        'total',
        'user_id',
    ];
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function returnSaleItems()
    {
        return $this->hasMany(ReturnSaleItem::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
