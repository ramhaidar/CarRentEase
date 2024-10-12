<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    /**
     * Menampilkan daftar mobil yang sedang disewa oleh pengguna.
     */
    public function index ()
    {
        $peminjamans = Peminjaman::where ( 'user_id', Auth::id () )->with ( 'mobil' )->get ();
        return view ( 'peminjaman.index', compact ( 'peminjamans' ) );
    }

    /**
     * Menampilkan form untuk memesan mobil.
     */
    public function create ()
    {
        $mobils = Mobil::where ( 'tersedia', true )->get ();
        return view ( 'peminjaman.create', compact ( 'mobils' ) );
    }

    /**
     * Menyimpan data pemesanan mobil.
     */
    public function store ( Request $request )
    {
        $request->validate ( [ 
            'mobil_id'        => 'required|exists:mobils,id',
            'tanggal_mulai'   => 'required|date|after_or_equal:today',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
        ] );

        $mobil = Mobil::find ( $request->mobil_id );

        if ( ! $mobil->tersedia )
        {
            return redirect ()->back ()->withErrors ( 'Mobil tidak tersedia.' );
        }

        Peminjaman::create ( [ 
            'user_id'         => Auth::id (),
            'mobil_id'        => $mobil->id,
            'tanggal_mulai'   => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
        ] );

        $mobil->update ( [ 'tersedia' => false ] );

        return redirect ()->route ( 'peminjaman.index' )->with ( 'success', 'Mobil berhasil dipesan' );
    }
}
