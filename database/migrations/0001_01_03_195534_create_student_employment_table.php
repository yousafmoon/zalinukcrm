<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentEmploymentTable extends Migration
{
    public function up()
    {
        // Student Employment table
        Schema::create('student_employment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->text('personal_circumstances')->nullable();
            $table->text('employment_details')->nullable();
            $table->text('present_work')->nullable();
            $table->string('company_name')->nullable();
            $table->date('job_start_date')->nullable();
            $table->string('work_address')->nullable();
            $table->string('employer_phone')->nullable();
            $table->string('employer_email')->nullable();
            $table->text('additional_jobs')->nullable();
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('student_employment');
    }
}
