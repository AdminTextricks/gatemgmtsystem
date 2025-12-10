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
        Schema::create('fee_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_admissions_id');
            $table->foreign('student_admissions_id')->references('id')->on('student_admissions');
            $table->date('transition_date');
            $table->string('duration', 50); 
            $table->string('fee_periods', 50); 
            $table->decimal('transition_amount', 10, 2);
            $table->string('transaction_id')->unique()->nullable();
            $table->string('receipt_image')->nullable(); 
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->enum('status', ['pending', 'paid', 'fail'])->default('pending');
            $table->text('reject_reason')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_details');
    }
};
