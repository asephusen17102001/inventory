<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    /** @use HasFactory<\Database\Factories\TransactionFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'tanggal_ransaction',
        'store_id',
        'nomor_transaction',
        'type',
    ];

    protected $dates = [
        'deleted_at',
    ];


    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function detailProductTransactions()
    {
        return $this->hasMany(DetailProductTransaction::class);
    }

    public function getTanggalRansactionAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d F Y  H:i');
    }
}
