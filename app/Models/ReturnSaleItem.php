<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnSaleItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'return_sale_id',
        'product_id',
        'quantity',
        'unit_price',
        'total',
    ];
    public function returnSale()
    {
        return $this->belongsTo(ReturnSale::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
  
}
