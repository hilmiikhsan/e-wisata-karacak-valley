<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    protected $table = 'facilities';

    public function wisatas()
    {
        return $this->belongsToMany('App\Wisata', 'wisata_facility', 'facility_id', 'wisata_id');
    }

    public function transaksi_details()
    {
        return $this->hasMany('App\TransactionDetail',);
    }

    /**
     * Cek apakah fasilitas dimiliki oleh Wisata
     */
    public function getIsHavingWisataAttribute()
    {
        return $this->hasMany('App/WisataFasilitas', 'facility_id', 'id')->exist();
    }

    protected $appends = [
        'is_related'
    ];

}
