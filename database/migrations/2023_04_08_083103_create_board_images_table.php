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
        Schema::create('board_images', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('board_id');
            $table->unsignedBigInteger('image_id');

            $table->index('board_id', 'board_image_board_idx');
            $table->index('image_id', 'board_image_image_idx');

            $table->foreign('board_id', 'board_image_board_fk')->on('boards')->references('id');
            $table->foreign('image_id', 'board_image_image_fk')->on('images')->references('id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('board_images');
    }
};
