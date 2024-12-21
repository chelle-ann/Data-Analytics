<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    // Relationship with Sales
    public function sales()
    {
        return $this->hasMany(Sale::class, 'DealerID', 'DealerID');
    }
}

