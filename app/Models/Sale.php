<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    // Relationship with Car
    public function car()
    {
        return $this->belongsTo(Car::class, 'CarID', 'CarID');
    }

    // Relationship with Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'CustomerID', 'CustomerID');
    }

    // Relationship with Dealer
    public function dealer()
    {
        return $this->belongsTo(Dealer::class, 'DealerID', 'DealerID');
    }
}

