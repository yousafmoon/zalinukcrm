<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormDetailsTables extends Migration
{
    public function up()
    {


        // Passport Details table
        Schema::create('passport_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->string('passport_number')->nullable();
            $table->string('place_of_issue')->nullable();
            $table->string('issuing_authority')->nullable();
            $table->date('date_of_issue')->nullable();
            $table->date('date_of_expiry')->nullable();
            $table->timestamps();
        });

    }

    public function down()
    {

        Schema::dropIfExists('passport_details');

    }
}
