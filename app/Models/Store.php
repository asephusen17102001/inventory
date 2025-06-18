<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    /** @use HasFactory<\Database\Factories\StoreFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'branch_id',
        'name',
        'address',
        'name_pic',
        'contact',
        'status'
    ];

    protected $dates = ['deleted_at'];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function storeProducts()
    {
        return $this->hasMany(StoreProduct::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
