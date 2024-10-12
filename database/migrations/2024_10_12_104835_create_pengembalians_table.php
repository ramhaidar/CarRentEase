<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up () : void
    {
        Schema::create ( 'pengembalians', function (Blueprint $table)
        {
            $table->id ();
            $table->foreignId ( 'peminjaman_id' )->constrained ( 'peminjamans' )->onDelete ( 'cascade' );
            $table->date ( 'tanggal_pengembalian' );
            $table->integer ( 'jumlah_hari' );
            $table->decimal ( 'total_biaya', 10, 2 );
            $table->timestamps ();
        } );
    }

    /**
     * Reverse the migrations.
     */
    public function down () : void
    {
        Schema::dropIfExists ( 'pengembalians' );
    }
};
