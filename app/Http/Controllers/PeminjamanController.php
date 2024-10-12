<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index ()
    {
        $peminjamans     = Peminjaman::where ( 'user_id', Auth::id () )->where ( 'status_pengembalian', false )->with ( 'mobil' )->get ();
        $mobils_tersedia = Mobil::whereDoesntHave ( 'peminjamans', function ($query)
        {
            $query->where ( 'status_pengembalian', false );
        } )->where ( 'tersedia', true )->get ();
        return view ( 'peminjaman.peminjaman', compact ( 'peminjamans', 'mobils_tersedia' ) );
    }

    public function create ()
    {
        $mobils = Mobil::whereDoesntHave ( 'peminjamans', function ($query)
        {
            $query->where ( 'status_pengembalian', false );
        } )->where ( 'tersedia', true )->get ();
        return view ( 'peminjaman.create', compact ( 'mobils' ) );
    }

    public function store ( Request $request )
    {
        $request->validate ( [ 
            'mobil_id'        => 'required|exists:mobils,id',
            'tanggal_mulai'   => 'required|date|after_or_equal:today',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai'
        ] );

        $mobil = Mobil::findOrFail ( $request->mobil_id );

        if ( $mobil->tersedia )
        {
            Peminjaman::create ( [ 
                'user_id'             => Auth::id (),
                'mobil_id'            => $mobil->id,
                'tanggal_mulai'       => $request->tanggal_mulai,
                'tanggal_selesai'     => $request->tanggal_selesai,
                'status_pengembalian' => false
            ] );

            $mobil->update ( [ 'tersedia' => false ] );

            return redirect ()->route ( 'peminjaman.index' )->with ( 'success', 'Mobil berhasil dipesan' );
        }

        return redirect ()->back ()->with ( 'error', 'Mobil tidak tersedia untuk disewa' );
    }
}
