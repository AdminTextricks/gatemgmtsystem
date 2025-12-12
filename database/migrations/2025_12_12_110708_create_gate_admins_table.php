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
        Schema::create('gate_admins', function (Blueprint $table) {
            $table->id();
            $table->string('gate_admin_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mobile', 15)->nullable();
            $table->string('device_id')->nullable();
            $table->string('gate_no')->nullable();
            $table->string('shift')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=Active, 0=Inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gate_admins');
    }
};
