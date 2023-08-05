<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionDetail extends Model
{
    use SoftDeletes;
    protected $table = 'transactions_detail';

    public function transaksi()
    {
        return $this->belongsTo('App\Transaction');
    }

    public function fasilitas()
    {
        return $this->belongsTo('App\Fasilitas');
    }
}
