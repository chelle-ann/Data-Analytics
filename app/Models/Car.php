<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    // Define the relationship with Sales
    public function sales()
    {
        return $this->hasMany(Sale::class, 'CarID', 'CarID');
    }
}

