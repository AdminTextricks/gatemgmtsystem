<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('student_admissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('enroll_number', 255)->nullable()->index();
            $table->string('session', 255)->nullable()->index();
            $table->string('admission_date', 255)->nullable();
            $table->unsignedBigInteger('cur_class_id');
            $table->unsignedBigInteger('adm_class_id');
            $table->string('student_name', 255)->nullable()->index();
            $table->enum('type', ['Army','Civilian'])->nullable();
            $table->string('fathers_name')->nullable();
            $table->string('mothers_name')->nullable();
            $table->text('address')->nullable();    
            $table->string('state_id', 255)->nullable()->index();
            $table->string('city_id', 255)->nullable()->index();
            $table->string('mobile', 255)->nullable();
            $table->enum('sex', ['Male','Female'])->nullable();
            $table->string('dob')->nullable();
            $table->string('age')->nullable();
            $table->unsignedBigInteger('disability_id');
            $table->string('unique_identity_no')->nullable();
            $table->string('aadhar_no')->nullable();
            $table->text('individual_educational_plan')->nullable();
            $table->string('therapy')->nullable();
            $table->text('vocational_and_skill_training')->nullable();
            $table->text('special_achievements')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->foreign('cur_class_id')->references('id')->on('class_masters');
            $table->foreign('disability_id')->references('id')->on('disability_matsers');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('student_admissions');
    }
};
