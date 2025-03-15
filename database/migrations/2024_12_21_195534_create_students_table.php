<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormDetailsTables extends Migration
{
    public function up()
    {
        // Students table
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('choice_of_country')->nullable();
            $table->date('intake')->nullable();
            $table->string('intended_course')->nullable();
            $table->string('firstname')->nullable();
            $table->string('middlename')->nullable();
            $table->string('surname')->nullable();
            $table->string('nickname')->nullable();
            $table->string('email')->nullable();
            $table->string('gender')->nullable();
            $table->string('nationality')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('national_insurance')->nullable();
            $table->string('other_nationalities')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('criminal_conviction')->nullable();
            $table->string('police_clearance')->nullable();
            $table->string('disability')->nullable();
            $table->string('fircopy')->nullable();
            $table->string('living_situation')->nullable();
            $table->text('correspondence_address')->nullable();
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
}
