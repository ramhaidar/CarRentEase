<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengembalianController extends Controller
{
    public function index ()
    {
        $pengembalians = Pengembalian::whereHas ( 'peminjaman', function ($query)
        {
            $query->where ( 'user_id', Auth::id () );
        } )->with ( 'peminjaman.mobil' )->get ();

        return view ( 'pengembalian.pengembalian', compact ( 'pengembalians' ) );
    }

    public function store ( Request $request )
    {
        $request->validate ( [ 
            'nomor_plat' => 'required|string'
        ] );

        $mobil = Mobil::where ( 'nomor_plat', $request->nomor_plat )->first ();

        if ( ! $mobil )
        {
            return redirect ()->route ( 'pengembalian.index' )->with ( 'error', 'Nomor plat tidak ditemukan.' );
        }

        $peminjaman = Peminjaman::where ( 'mobil_id', $mobil->id )
            ->where ( 'user_id', Auth::id () )
            ->where ( 'status_pengembalian', false )
            ->first ();

        if ( ! $peminjaman )
        {
            return redirect ()->route ( 'pengembalian.index' )->with ( 'error', 'Anda tidak meminjam mobil ini.' );
        }

        $jumlah_hari = $peminjaman->tanggal_mulai->diffInDays ( $peminjaman->tanggal_selesai );
        if ( $jumlah_hari == 0 ) $jumlah_hari = 1;

        $total_biaya = $jumlah_hari * $mobil->tarif_sewa_per_hari;

        Pengembalian::create ( [ 
            'peminjaman_id'        => $peminjaman->id,
            'tanggal_pengembalian' => now (),
            'jumlah_hari'          => $jumlah_hari,
            'total_biaya'          => $total_biaya
        ] );

        $peminjaman->update ( [ 'status_pengembalian' => true ] );
        $mobil->update ( [ 'tersedia' => true ] );

        return redirect ()->route ( 'pengembalian.index' )->with ( 'success', 'Mobil berhasil dikembalikan. Total biaya: Rp' . number_format ( $total_biaya, 2 ) );
    }
}
