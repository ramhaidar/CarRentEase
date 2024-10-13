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
        $peminjamans = Peminjaman::where ( 'user_id', Auth::id () )
            ->where ( 'status_pengembalian', false )
            ->with ( 'mobil' )
            ->get ();

        return view ( 'peminjaman.peminjaman', compact ( 'peminjamans' ) );
    }

    public function create ( Request $request )
    {
        if ( ! $request->filled ( 'tanggal_mulai' ) || ! $request->filled ( 'tanggal_selesai' ) )
        {
            return view ( 'peminjaman.create', [ 'mobils' => collect () ] );
        }

        $request->validate ( [ 
            'tanggal_mulai'   => 'required|date|after_or_equal:today',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
        ] );

        $mobils = Mobil::whereDoesntHave ( 'peminjamans', function ($query) use ($request)
        {
            $query->where ( function ($q) use ($request)
            {
                $q->whereBetween ( 'tanggal_mulai', [ $request->tanggal_mulai, $request->tanggal_selesai ] )
                    ->orWhereBetween ( 'tanggal_selesai', [ $request->tanggal_mulai, $request->tanggal_selesai ] )
                    ->orWhere ( function ($q) use ($request)
                    {
                        $q->where ( 'tanggal_mulai', '<=', $request->tanggal_mulai )
                            ->where ( 'tanggal_selesai', '>=', $request->tanggal_selesai );
                    } );
            } )->where ( 'status_pengembalian', false );
        } )->get ();

        return view ( 'peminjaman.create', compact ( 'mobils' ) );
    }

    public function store ( Request $request )
    {
        $request->validate ( [ 
            'mobil_id'        => 'required|exists:mobils,id',
            'tanggal_mulai'   => 'required|date|after_or_equal:today',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
        ] );

        $mobil = Mobil::findOrFail ( $request->mobil_id );

        $isAvailable = ! Peminjaman::where ( 'mobil_id', $mobil->id )
            ->where ( 'status_pengembalian', false )
            ->where ( function ($query) use ($request)
            {
                $query->whereBetween ( 'tanggal_mulai', [ $request->tanggal_mulai, $request->tanggal_selesai ] )
                    ->orWhereBetween ( 'tanggal_selesai', [ $request->tanggal_mulai, $request->tanggal_selesai ] )
                    ->orWhere ( function ($q) use ($request)
                    {
                        $q->where ( 'tanggal_mulai', '<=', $request->tanggal_mulai )
                            ->where ( 'tanggal_selesai', '>=', $request->tanggal_selesai );
                    } );
            } )->exists ();

        if ( $isAvailable )
        {
            Peminjaman::create ( [ 
                'user_id'             => Auth::id (),
                'mobil_id'            => $mobil->id,
                'tanggal_mulai'       => $request->tanggal_mulai,
                'tanggal_selesai'     => $request->tanggal_selesai,
                'status_pengembalian' => false,
            ] );

            return redirect ()->route ( 'peminjaman.index' )->with ( 'success', 'Mobil berhasil dipesan' );
        }

        return redirect ()->back ()->with ( 'error', 'Mobil tidak tersedia untuk disewa pada tanggal yang dipilih' );
    }
}
