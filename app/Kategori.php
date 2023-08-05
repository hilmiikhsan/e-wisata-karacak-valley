<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'categories';

    /**
     * Get the wisata that owns the category.
     */
    public function wisatas()
    {
        return $this->hasMany('App\Wisata');
    }
}
