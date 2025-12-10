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
        Schema::create('academic_report_co_curricula', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_admissions_id');
            $table->string('co_curriculum')->nullable();
            $table->string('quarter_1',25)->nullable();
            $table->string('quarter_2',25)->nullable();
            $table->string('quarter_3',25)->nullable();
            $table->string('Remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_report_co_curricula');
    }
};
