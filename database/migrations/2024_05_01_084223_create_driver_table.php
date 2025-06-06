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
        Schema::create('driver', function (Blueprint $table) {
            $table->id();
            $table->string('plate_no', 6);
            $table->string('brgy', 5);
            $table->string('city', 15);
            $table->integer('rating_tot')->default(0);
            ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver');
    }
};
