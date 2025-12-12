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
        Schema::create('visitor_details', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('mobile');
            $table->string('uid')->unique();
            $table->string('block_no')->nullable();
            $table->string('flat_no')->nullable();
            $table->date('date')->nullable();
            $table->string('duration')->nullable();
            $table->integer('max_allow_days')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->string('visitor_key')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('created_for')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitor_details');
    }
};
