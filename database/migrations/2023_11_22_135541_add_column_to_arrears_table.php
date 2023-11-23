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
            $table->unsignedBigInteger('student_id')->after('updated_by');
            $table->unsignedBigInteger('payment_id')->after('student_id');
            $table->string('month')->after('payment_id');
            $table->integer('amount_of_arrears')->after('month');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade');
        });
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
