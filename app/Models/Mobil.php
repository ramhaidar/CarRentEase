<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;

    protected $table = 'mobils';

    protected $fillable = [ 
        'merek',
        'model',
        'nomor_plat',
        'tarif_sewa_per_hari',
    ];

    public function peminjamans ()
    {
        return $this->hasMany ( Peminjaman::class);
    }
}
