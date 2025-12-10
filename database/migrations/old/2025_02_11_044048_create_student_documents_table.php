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
        Schema::create('student_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('student_admissions_id');
            $table->string('image', 255)->nullable();
            $table->string('aadhar_image', 255)->nullable();
            $table->string('birth_certificate_image', 255)->nullable();
            $table->string('disability_certificate_image', 255)->nullable();
            $table->string('medical_certificate_image', 255)->nullable();
            $table->string('udid_certificate_image', 255)->nullable();
            $table->string('transfer_certificate_image', 255)->nullable();
            $table->string('doc_prescription', 255)->nullable();
            $table->string('other_document_1', 255)->nullable();
            $table->string('other_document_2', 255)->nullable();
            $table->string('case_history', 255)->nullable();
            $table->timestamps();
            $table->foreign('student_admissions_id')->references('id')->on('student_admissions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_documents');
    }
};
