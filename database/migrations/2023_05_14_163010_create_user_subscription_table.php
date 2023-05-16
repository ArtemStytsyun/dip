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
        Schema::create('user_subscription', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->index('user_id', 'us_user_idx');
            $table->foreign('user_id', 'us_user_fk')->on('users')->references('id')->onDelete('cascade');

            $table->unsignedBigInteger('subscription_id')->nullable();
            $table->index('subscription_id', 'us_subscription_idx');
            $table->foreign('subscription_id', 'us_subscription_fk')->on('users')->references('id')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_subsription');
    }
};
