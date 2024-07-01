<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('musics', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Singer::class)->constrained()->cascadeOnDelete(); //singer dlt huda songs ni dlt hunxa ni raaja
            $table->string('title');
            $table->string('album_name');
            $table->enum('genre', ['jazz', 'rock', 'classic', 'pop', 'country', 'rnb']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('musics');
    }
};
