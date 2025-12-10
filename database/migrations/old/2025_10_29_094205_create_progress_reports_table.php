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
        Schema::create('progress_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_admissions_id');
            $table->string('domain')->nullable();
            $table->string('no_of_activities_assessed')->nullable();
            $table->string('maxm_score',25)->nullable();
            $table->string('baseline_score',25)->nullable();
            $table->string('baseline_percentage',25)->nullable();
            $table->string('first_qtr_score',25)->nullable();
            $table->string('first_qtr_percentage',25)->nullable();
            $table->string('second_qtr_score',25)->nullable();
            $table->string('second_qtr_percentage',25)->nullable();
            $table->string('third_qtr_score',25)->nullable();
            $table->string('third_qtr_percentage',25)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress_reports');
    }
};
