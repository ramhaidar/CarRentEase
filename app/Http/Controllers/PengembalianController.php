<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Mobil;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengembalianController extends Controller
{
    public function index ()
    {
        $pengembalians = Pengembalian::where ( 'user_id', Auth::id () )->with ( 'mobil' )->get ();
        return view ( 'pengembalian.index', compact ( 'pengembalians' ) );
    }

    public function store ( Request $request )
    {
        $request->validate ( [ 
            'nomor_plat' => 'required|string|exists:mobils,nomor_plat',
        ] );

        $mobil      = Mobil::where ( 'nomor_plat', $request->nomor_plat )->first ();
        $peminjaman = Peminjaman::where ( 'mobil_id', $mobil->id )
            ->where ( 'user_id', Auth::id () )
            ->whereNull ( 'tanggal_pengembalian' )
            ->first ();

        if ( ! $peminjaman )
        {
            return redirect ()->back ()->withErrors ( 'Mobil tidak sedang disewa oleh Anda.' );
        }

        $tanggal_mulai   = Carbon::parse ( $peminjaman->tanggal_mulai );
        $tanggal_selesai = Carbon::parse ( $request->tanggal_selesai ?? now () );
        $jumlah_hari     = $tanggal_mulai->diffInDays ( $tanggal_selesai ) + 1;

        $total_biaya = $jumlah_hari * $mobil->tarif_sewa_per_hari;

        Pengembalian::create ( [ 
            'peminjaman_id'        => $peminjaman->id,
            'tanggal_pengembalian' => now (),
            'jumlah_hari'          => $jumlah_hari,
            'total_biaya'          => $total_biaya,
        ] );

        $mobil->update ( [ 'tersedia' => true ] );

        $peminjaman->update ( [ 'tanggal_pengembalian' => now () ] );

        return redirect ()->route ( 'pengembalian.index' )->with ( 'success', 'Mobil berhasil dikembalikan' );
    }
}