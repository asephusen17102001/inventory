<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class StoreProduct extends Model
{
    //

    protected $table = 'store_products';
    protected $fillable = [
        'store_id',
        'product_id',
        'stock',
        'stock_product_repair',
    ];


    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
