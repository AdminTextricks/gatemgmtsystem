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
        Schema::create('progress_report_mains', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_admissions_id');
            $table->string('progress_report_year')->nullable();
            $table->text('pen_picture')->nullable();            
            $table->string('dates_of_assessment')->nullable();
            $table->string('baseline')->nullable();
            $table->string('first_qtr')->nullable();
            $table->string('second_qtr')->nullable();
            $table->string('third_qtr')->nullable();            
            $table->text('teacher_remarks')->nullable();
            $table->text('principal_remarks')->nullable();
            $table->timestamps();
            $table->foreign('student_admissions_id')->references('id')->on('student_admissions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress_report_mains');
    }
};
