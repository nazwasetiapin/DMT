<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('uploads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('type'); // foto / video
            $table->string('file'); // path file
            $table->text('request_note')->nullable(); // komentar user
            $table->string('bukti')->nullable();
            $table->integer('harga');
            $table->string('status')->default('pending'); // tunggu | proses | selesai
            $table->string('processed_file')->nullable(); // file hasil edit
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('uploads');
    }
};
