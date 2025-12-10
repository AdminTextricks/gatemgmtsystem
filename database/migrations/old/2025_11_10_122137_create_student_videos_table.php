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
        Schema::create('student_videos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_admissions_id');
            $table->string('therapy_name', 255)->nullable();
            $table->string('cur_class', 255)->nullable();
            $table->string('domain_name', 255)->nullable();
            $table->string('video', 255)->nullable();
            $table->text('description')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->foreign('student_admissions_id')->references('id')->on('student_admissions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_videos');
    }
};
