<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProfileController,
    ManajemenController,
    PeminjamanController,
    PengembalianController
};

Route::get ( '/', fn () => redirect ()->route ( 'login' ) );

Route::get ( '/dashboard', function ()
{
    return Auth::check () ? view ( 'dashboards.dashboard' ) : redirect ()->route ( 'login' );
} )->middleware ( [ 'auth', 'verified' ] )->name ( 'dashboard' );

Route::middleware ( 'auth' )->group ( function ()
{

    Route::prefix ( 'profile' )->group ( function ()
    {
        Route::get ( '/', [ ProfileController::class, 'edit' ] )->name ( 'profile.edit' );
        Route::patch ( '/', [ ProfileController::class, 'update' ] )->name ( 'profile.update' );
        Route::delete ( '/', [ ProfileController::class, 'destroy' ] )->name ( 'profile.destroy' );
    } );

    Route::prefix ( 'manajemen' )->group ( function ()
    {
        Route::get ( '/', [ ManajemenController::class, 'index' ] )->name ( 'manajemen.index' );
        Route::get ( '/create', [ ManajemenController::class, 'create' ] )->name ( 'manajemen.create' );
        Route::post ( '/', [ ManajemenController::class, 'store' ] )->name ( 'manajemen.store' );
        Route::get ( '/{id}/edit', [ ManajemenController::class, 'edit' ] )->name ( 'manajemen.edit' );
        Route::put ( '/{id}', [ ManajemenController::class, 'update' ] )->name ( 'manajemen.update' );
        Route::delete ( '/{id}', [ ManajemenController::class, 'destroy' ] )->name ( 'manajemen.destroy' );
        Route::get ( '/{id}', [ ManajemenController::class, 'show' ] )->name ( 'manajemen.show' );
    } );

    Route::prefix ( 'peminjaman' )->group ( function ()
    {
        Route::get ( '/', [ PeminjamanController::class, 'index' ] )->name ( 'peminjaman.index' );
        Route::get ( '/create', [ PeminjamanController::class, 'create' ] )->name ( 'peminjaman.create' );
        Route::post ( '/', [ PeminjamanController::class, 'store' ] )->name ( 'peminjaman.store' );
    } );

    Route::prefix ( 'pengembalian' )->group ( function ()
    {
        Route::get ( '/', [ PengembalianController::class, 'index' ] )->name ( 'pengembalian.index' );
        Route::post ( '/', [ PengembalianController::class, 'store' ] )->name ( 'pengembalian.store' );
    } );

} );

require __DIR__ . '/auth.php';
