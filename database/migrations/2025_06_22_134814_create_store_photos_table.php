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
        Schema::create('store_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_store_id')->constrained('car_stores')->cascadeOnDelete();
            $table->string('photo'); // <--- tambahkan baris ini
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_photos');
    }
};
