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
        Schema::create('teacher_masters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('teacher_id')->nullable();
            $table->string('teacher_name')->nullable();
            $table->string('address')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('experience')->nullable();
            $table->timestamp('date_of_joining')->nullable();
            $table->string('proficiency')->nullable();
            $table->foreignId('class_id')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

            $table->foreign('class_id')->references('id')->on('class_masters')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_masters');
    }
};
