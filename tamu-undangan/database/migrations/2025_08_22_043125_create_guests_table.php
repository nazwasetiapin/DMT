<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('name');                           // nama tamu
            $table->string('whatsapp')->unique();             // no WA unik
            $table->string('address');                        // alamat
            $table->text('message');                          // ucapan
            $table->enum('gift_type', ['transfer','cash','barang']); // jenis hadiah

            // tambahan sesuai pilihan hadiah
            $table->integer('cash_amount')->nullable();       // nominal cash
            $table->integer('transfer_amount')->nullable();   // nominal transfer
            $table->string('transfer_method')->nullable();    // metode transfer
            $table->string('barang_name')->nullable();        // nama barang

            $table->string('proof')->nullable();              // bukti transfer
            $table->string('photo')->nullable();              // foto tamu
            $table->timestamps();
        });
    }

    /**
     * Rollback migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
