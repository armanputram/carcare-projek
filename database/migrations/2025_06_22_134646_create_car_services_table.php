<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('car_services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('photo');
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('duration_in_hour');
            $table->text('about');
            $table->string('slug')->unique();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('car_services');
    }
};
