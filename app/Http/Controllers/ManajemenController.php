<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;

class ManajemenController extends Controller
{
    public function index ( Request $request )
    {
        $query = Mobil::query ();

        if ( $request->filled ( 'merek' ) )
        {
            $query->where ( 'merek', 'like', '%' . $request->merek . '%' );
        }

        if ( $request->filled ( 'model' ) )
        {
            $query->where ( 'model', 'like', '%' . $request->model . '%' );
        }

        if ( $request->filled ( 'tersedia' ) )
        {
            $query->where ( 'tersedia', $request->tersedia );
        }

        $mobils = $query->get ();

        return view ( 'manajemen.manajemen', compact ( 'mobils' ) );
    }

    public function create ()
    {
        return view ( 'manajemen.create' );
    }

    public function store ( Request $request )
    {
        $request->validate ( [ 
            'merek'               => 'required|string|max:255',
            'model'               => 'required|string|max:255',
            'nomor_plat'          => 'required|string|max:20|unique:mobils',
            'tarif_sewa_per_hari' => 'required|numeric',
        ] );

        Mobil::create ( [ 
            'merek'               => $request->merek,
            'model'               => $request->model,
            'nomor_plat'          => $request->nomor_plat,
            'tarif_sewa_per_hari' => $request->tarif_sewa_per_hari,
            'tersedia'            => true,
        ] );

        return redirect ()->route ( 'manajemen.index' )->with ( 'success', 'Mobil berhasil ditambahkan' );
    }

    public function edit ( $id )
    {
        $mobil = Mobil::findOrFail ( $id );
        return view ( 'manajemen.edit', compact ( 'mobil' ) );
    }

    public function update ( Request $request, $id )
    {
        $request->validate ( [ 
            'merek'               => 'required|string|max:255',
            'model'               => 'required|string|max:255',
            'nomor_plat'          => 'required|string|max:20|unique:mobils,nomor_plat,' . $id,
            'tarif_sewa_per_hari' => 'required|numeric',
        ] );

        $mobil = Mobil::findOrFail ( $id );
        $mobil->update ( [ 
            'merek'               => $request->merek,
            'model'               => $request->model,
            'nomor_plat'          => $request->nomor_plat,
            'tarif_sewa_per_hari' => $request->tarif_sewa_per_hari,
        ] );

        return redirect ()->route ( 'manajemen.index' )->with ( 'success', 'Mobil berhasil diperbarui' );
    }

    public function destroy ( $id )
    {
        $mobil = Mobil::findOrFail ( $id );
        $mobil->delete ();

        return redirect ()->route ( 'manajemen.index' )->with ( 'success', 'Mobil berhasil dihapus' );
    }

    public function show ( $id )
    {
        $mobil = Mobil::findOrFail ( $id );
        return view ( 'manajemen.show', compact ( 'mobil' ) );
    }
}
