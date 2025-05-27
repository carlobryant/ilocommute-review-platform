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
        Schema::create('review', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('driver_id');
            $table->string('pickup', 60);
            $table->string('destination', 60);
            $table->integer('rating');
            $table->text('comment');
            $table->string('id_url', 2000)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->foreign('driver_id')->references('id')->on('driver')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review');
    }
};
