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
        Schema::create('equipment_masters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('equipment_id', 255)->nullable();
            $table->string('name', 255)->nullable();
            $table->string('date_of_purchase')->nullable();
            $table->string('description')->nullable();
            $table->string('warranty_status')->nullable();
            $table->string('service_status')->nullable();
            $table->string('image')->nullable();
            $table->string('eqp_video')->nullable();
            $table->tinyInteger('status')->nullable()->default(1);
            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment_masters');
    }
};
