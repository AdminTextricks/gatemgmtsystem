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
        Schema::create('academic_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_admissions_id');
            $table->string('subjects')->nullable();
            $table->string('quarter_1',25)->nullable();
            $table->string('quarter_2',25)->nullable();
            $table->string('quarter_3',25)->nullable();
            $table->string('max_marks',200)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_reports');
    }
};
