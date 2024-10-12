<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;

Route::get ( '/', function ()
{
    return redirect ()->route ( 'login' );
} );

Route::get ( '/dashboard', function ()
{
    $user = Auth::user ();

    // IF USER IS AUTHENTICATED THEN RETURN VIEW DASHBOARD
    if ( $user )
    {
        return view ( 'dashboards.dashboard' );
    }

    // if ( $user->isAdmin () )
    // {
    //     return view ( 'dashboards.admin.dashboard' );
    // }
    // elseif ( $user->isUser () )
    // {
    //     return view ( 'dashboards.user.dashboard' );
    // }

    // abort ( 403, 'Unauthorized' );
    return redirect ()->route ( 'login' );
} )->middleware ( [ 'auth', 'verified' ] )->name ( 'dashboard' );


Route::middleware ( 'auth' )->group ( function ()
{
    Route::get ( '/profile', [ ProfileController::class, 'edit' ] )->name ( 'profile.edit' );
    Route::patch ( '/profile', [ ProfileController::class, 'update' ] )->name ( 'profile.update' );
    Route::delete ( '/profile', [ ProfileController::class, 'destroy' ] )->name ( 'profile.destroy' );
} );

// Route::middleware ( [ 'role:admin' ] )->group ( function ()
// {
//     Route::get ( '/admin/dashboard', [ AdminController::class, 'index' ] )->name ( 'admin.dashboard' );
// } );

// Route::middleware ( [ 'role:user' ] )->group ( function ()
// {
//     Route::get ( '/user/dashboard', [ UserController::class, 'index' ] )->name ( 'user.dashboard' );
// } );

Route::get ( '/mobils', [ MobilController::class, 'index' ] )->name ( 'mobils.index' );
Route::get ( '/peminjaman', [ PeminjamanController::class, 'index' ] )->name ( 'peminjaman.index' );
Route::get ( '/pengembalian', [ PengembalianController::class, 'index' ] )->name ( 'pengembalian.index' );

require __DIR__ . '/auth.php';
