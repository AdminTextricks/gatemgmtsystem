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
        Schema::create('progress_report_co_curriculars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_admissions_id');
            $table->string('domain')->nullable();
            $table->string('no_of_activities_assessed')->nullable();
            $table->string('baseline')->nullable();
            $table->string('first_qtr',25)->nullable();
            $table->string('second_qtr',25)->nullable();
            $table->string('third_qtr',25)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress_report_co_curriculars');
    }
};
