<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'phone'
    ];
    public function sales(){
        return $this->hasMany(Sale::class);  // Assuming Sale model has a foreign key 'customer_id'
    }
    
    
}
