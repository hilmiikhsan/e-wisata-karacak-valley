<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;
    protected $table = 'transactions';

    /**
     * Date from
     * 
     * @var string
     */
    public static $date_from;

    /**
     * Date to
     * 
     * @var string
     */
    public static $date_to;

    /**
     * Sample mutator nih, tinggal lu modif
     *
     * @return string
     */
    public function getFixedGrandTotalLunasAttribute()
    {
        $id = $this->id;
        if(self::$date_from == '' && self::$date_to == '') {
            return $fixed_grand_total = $this::where('status', 1)->first()->grand_total;
        } else {
            return $fixed_grand_total = $this::where('status', 1)->first()->grand_total;
        }
    }

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'fixed_grand_total_lunas',
    ];

    public function wisata()
    {
        return $this->belongsTo('App\Wisata');
    }

    public function member()
    {
        return $this->belongsTo('App\User');
    }

    public function transaksi_detail()
    {
        return $this->hasMany('App\TransactionDetail', 'transaction_id', 'id');
    }
}
