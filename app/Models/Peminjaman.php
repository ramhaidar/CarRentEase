<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjamans';
    protected $fillable = [ 
        'user_id',
        'mobil_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'status_pengembalian',
    ];

    public function user ()
    {
        return $this->belongsTo ( User::class);
    }

    public function mobil ()
    {
        return $this->belongsTo ( Mobil::class);
    }

    public function pengembalian ()
    {
        return $this->hasOne ( Pengembalian::class);
    }
}
