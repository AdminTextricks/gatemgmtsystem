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
        Schema::create('vistor_in_out_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visitor_id')->constrained('visitor_details')->cascadeOnDelete();
            $table->foreignId('visiting_detail_id')->constrained('visiting_details')->cascadeOnDelete();
            $table->date('visitor_in_time')->nullable();
            $table->date('visitor_out_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vistor_in_out_details');
    }
};
