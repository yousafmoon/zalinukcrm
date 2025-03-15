<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormDetailsTables extends Migration
{
    public function up()
    {
        // Spouse or Partners Accompanying table
        Schema::create('spouse_partners_accompanying_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->string('spouse_father_given_name')->nullable();
            $table->string('spouse_father_family_name')->nullable();
            $table->date('father_dob')->nullable();
            $table->string('father_place_of_birth')->nullable();
            $table->string('spouse_mother_given_name')->nullable();
            $table->string('spouse_mother_family_name')->nullable();
            $table->date('mother_dob')->nullable();
            $table->string('mother_place_of_birth')->nullable();
            $table->string('spouse_visa_valid_from')->nullable();
            $table->string('spouse_visa_expiry_date')->nullable();
            $table->string('spouse_visa_type')->nullable();
            $table->string('spouse_travel_history')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('spouse_partners_accompanying_details');
    }
}
