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
            $table->date('date')->nullable();
            $table->integer('duration')->default(0);         
            $table->integer('max_allow_days')->default(0);
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
