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
        Schema::table('arrears', function (Blueprint $table) {
            $table->string('created_by', 36)->nullable();
            $table->string('updated_by', 36)->nullable();
            $table->string('deleted_by', 36)->nullable();        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('arrears', function (Blueprint $table) {
            //
        });
    }
};
