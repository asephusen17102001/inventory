<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailProductTransaction extends Model
{
    //
    protected $table = 'detail_product_transactions';
    protected $fillable = [
        'transaction_id',
        'product_id',
        'qty',
        'type',
        'price',
    ];

    protected $casts = [
        'transaction_id' => 'integer',
        'product_id' => 'integer',
        'qty' => 'integer',
        'type' => 'string',
        'price' => 'integer',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
