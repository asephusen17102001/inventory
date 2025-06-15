<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'status', 'stock', 'stock_recondition', 'price', 'price_recondition'];
    protected $dates = ['deleted_at'];

    public function storeProducts()
    {
        return $this->hasMany(StoreProduct::class);
    }
}
