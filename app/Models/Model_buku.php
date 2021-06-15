<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Model_buku extends Model
{
    protected $table = 'master_buku';

    public function kategori_r(){
        return $this->belongsTo('App\Models\Model_kategori','kategori');
    }
}
