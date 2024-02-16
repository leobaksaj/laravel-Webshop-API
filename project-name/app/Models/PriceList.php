<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceList extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'sku'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'price_list_product')->withPivot('price')->withTimestamps();
    }
}
