<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ManajemenController;
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

Route::get ( '/manajemen', [ ManajemenController::class, 'index' ] )->name ( 'manajemen.index' );
Route::get ( '/peminjaman', [ PeminjamanController::class, 'index' ] )->name ( 'peminjaman.index' );
Route::get ( '/pengembalian', [ PengembalianController::class, 'index' ] )->name ( 'pengembalian.index' );

Route::get ( '/manajemen', [ ManajemenController::class, 'index' ] )->name ( 'manajemen.index' ); // Route untuk menampilkan daftar mobil
Route::get ( '/manajemen/create', [ ManajemenController::class, 'create' ] )->name ( 'manajemen.create' ); // Route untuk form tambah mobil
Route::post ( '/manajemen', [ ManajemenController::class, 'store' ] )->name ( 'manajemen.store' ); // Route untuk menyimpan mobil baru

Route::get ( '/manajemen/{id}/edit', [ ManajemenController::class, 'edit' ] )->name ( 'manajemen.edit' );
Route::put ( '/manajemen/{id}', [ ManajemenController::class, 'update' ] )->name ( 'manajemen.update' );
Route::delete ( '/manajemen/{id}', [ ManajemenController::class, 'destroy' ] )->name ( 'manajemen.destroy' );
Route::get ( '/manajemen/{id}', [ ManajemenController::class, 'show' ] )->name ( 'manajemen.show' );

require __DIR__ . '/auth.php';
