<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillingAddress extends Model
{
    protected $fillable = [
        'name', 'surname', 'country',
        'street', 'house_number', 'city', 'state', 'psc',
    ];
}
