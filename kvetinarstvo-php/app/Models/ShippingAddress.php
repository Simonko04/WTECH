<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    protected $fillable = [
        'name', 'surname', 'country',
        'street', 'house_number', 'city', 'state', 'psc',
    ];
}
