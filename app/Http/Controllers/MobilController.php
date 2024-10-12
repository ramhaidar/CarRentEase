<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;

class MobilController extends Controller
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

        return view ( 'mobils.index', compact ( 'mobils' ) );
    }

    public function create ()
    {
        return view ( 'mobils.create' );
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

        return redirect ()->route ( 'mobils.index' )->with ( 'success', 'Mobil berhasil ditambahkan' );
    }
}
