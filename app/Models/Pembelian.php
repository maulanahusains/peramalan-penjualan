<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function Produk()
    {
        return $this->belongsTo(Produk::class, 'kd_produk', 'id');
    }
}
