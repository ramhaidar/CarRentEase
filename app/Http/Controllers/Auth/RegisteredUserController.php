<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create () : View
    {
        return view ( 'auth.register' );
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store ( Request $request ) : RedirectResponse
    {
        $request->validate ( [ 
            'name'          => [ 'required', 'string', 'max:255' ],
            'username'      => [ 'required', 'string', 'max:255', 'unique:' . User::class],
            'alamat'        => [ 'required', 'string', 'max:255' ],
            'nomor_telepon' => [ 'required', 'string', 'max:15' ],
            'nomor_sim'     => [ 'required', 'string', 'max:20', 'unique:' . User::class],
            'email'         => [ 'required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password'      => [ 'required', 'confirmed', Rules\Password::defaults () ],
        ] );

        $user = User::create ( [ 
            'name'          => $request->name,
            'username'      => $request->username,
            'alamat'        => $request->alamat,
            'nomor_telepon' => $request->nomor_telepon,
            'nomor_sim'     => $request->nomor_sim,
            'email'         => $request->email,
            'password'      => Hash::make ( $request->password ),
            'role'          => 'user',
        ] );

        event ( new Registered( $user ) );

        Auth::login ( $user );

        return redirect ( route ( 'dashboard', absolute: false ) );
    }
}
