<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    // Relationship with Sales
    public function sales()
    {
        return $this->hasMany(Sale::class, 'CustomerID', 'CustomerID');
    }
}

