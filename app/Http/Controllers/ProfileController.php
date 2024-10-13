<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit ( Request $request ) : View
    {
        return view ( 'profile.edit', [ 
            'user' => $request->user (),
        ] );
    }

    /**
     * Update the user's profile information.
     */
    public function update ( Request $request )
    {
        $user = Auth::user ();

        $request->validate ( [ 
            'name'          => 'required|string|max:255',
            'email'         => [ 
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique ( 'users', 'email' )->ignore ( $user->id ), // Mengabaikan email milik user saat ini
            ],
            'alamat'        => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:15',
            'nomor_sim'     => [ 
                'required',
                'string',
                'max:20',
                Rule::unique ( 'users', 'nomor_sim' )->ignore ( $user->id ), // Mengabaikan nomor SIM milik user saat ini
            ],
        ] );

        $user->update ( [ 
            'name'          => $request->name,
            'email'         => $request->email,
            'alamat'        => $request->alamat,
            'nomor_telepon' => $request->nomor_telepon,
            'nomor_sim'     => $request->nomor_sim,
        ] );

        return Redirect::route ( 'profile.edit' )
            ->with ( 'status', 'profile-updated' )
            ->with ( 'success', 'Profil berhasil diperbarui' );
    }

    /**
     * Delete the user's account.
     */
    public function destroy ( Request $request ) : RedirectResponse
    {
        $request->validateWithBag ( 'userDeletion', [ 
            'password' => [ 'required', 'current_password' ],
        ] );

        $user = $request->user ();

        Auth::logout ();

        $user->delete ();

        $request->session ()->invalidate ();
        $request->session ()->regenerateToken ();

        return Redirect::to ( '/' )->with ( 'success', 'Profil berhasil dihapus' );
    }
}
