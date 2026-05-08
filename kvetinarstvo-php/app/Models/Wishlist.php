<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    // TOTO JE DÔLEŽITÉ: Povieme Laravelu, že tvoja tabuľka sa volá "wishlist" a nie "wishlists"
    protected $table = 'wishlist';

    protected $fillable = [
        'user_id',
        'product_id',
    ];

    // Prepojenie na používateľa
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Prepojenie na produkt (s načítaním obrázkov)
    public function product()
    {
        return $this->belongsTo(Product::class)->with('images');
    }
}
