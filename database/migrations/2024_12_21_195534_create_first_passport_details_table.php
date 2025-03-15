<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormDetailsTables extends Migration
{
    public function up()
    {

        // First Passport Details table
        Schema::create('first_passport_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->string('previous_ppt_number')->nullable();
            $table->string('place_of_issue_previous')->nullable();
            $table->string('issuing_authority_previous')->nullable();
            $table->date('date_of_issue_previous')->nullable();
            $table->date('date_of_expiry_previous')->nullable();
            $table->string('national_id_number')->nullable();
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('first_passport_details');
    }
}
