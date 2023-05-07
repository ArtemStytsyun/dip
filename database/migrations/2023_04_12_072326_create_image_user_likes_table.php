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
        Schema::create('image_user_likes', function (Blueprint $table) {
            $table->id();
            
            
            $table->unsignedBigInteger('image_id')->nullable();
            $table->index('image_id', 'iul_image_idx');
            $table->foreign('image_id', 'iul_image_fk')->on('images')->references('id')->onDelete('cascade');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->index('user_id', 'iul_user_idx');
            $table->foreign('user_id', 'iul_user_fk')->on('users')->references('id')->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_user_likes');
    }
};
