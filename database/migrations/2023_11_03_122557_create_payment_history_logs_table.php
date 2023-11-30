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
        Schema::create('payment_history_logs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('payment_id',36)->index();
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade');
            $table->string('notes')->nullable;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_history_logs');
    }
};
