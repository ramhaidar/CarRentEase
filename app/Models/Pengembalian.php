<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    protected $table = 'pengembalians';

    protected $fillable = [ 
        'peminjaman_id',
        'tanggal_pengembalian',
        'jumlah_hari',
        'total_biaya',
    ];

    protected $casts = [ 
        'tanggal_pengembalian' => 'date',
    ];

    public function peminjaman ()
    {
        return $this->belongsTo ( Peminjaman::class);
    }

}
