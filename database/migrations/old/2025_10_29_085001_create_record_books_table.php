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
        Schema::create('record_books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('student_admissions_id');
            $table->unsignedBigInteger('class_id')->nullable();
            $table->year('year')->nullable();
            $table->string('record_book')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('student_admissions_id')
                ->references('id')
                ->on('student_admissions')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('record_books');
    }
};
