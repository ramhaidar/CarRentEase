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
        Schema::create ( 'mobils', function (Blueprint $table)
        {
            $table->id ();
            $table->string ( 'merek' );
            $table->string ( 'model' );
            $table->string ( 'nomor_plat' )->unique ();
            $table->integer ( 'tarif_sewa_per_hari' );
            $table->timestamps ();
        } );
    }

    /**
     * Reverse the migrations.
     */
    public function down () : void
    {
        Schema::dropIfExists ( 'mobils' );
    }
};
