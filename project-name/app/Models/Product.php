<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
        'sku',
        'is_published'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function priceLists()
    {
        return $this->belongsToMany(PriceList::class, 'price_list_product')->withPivot('price')->withTimestamps();
    }
}
