<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingCost extends Model
{
    protected $fillable = [
        'name',
        'price',
        'description'
    ];
    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

