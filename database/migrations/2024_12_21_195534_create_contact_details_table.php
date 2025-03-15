<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormDetailsTables extends Migration
{
    public function up()
    {
           
        // Contact Details table
        Schema::create('contact_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->string('address')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('how_long_lived')->nullable();
            $table->string('home_number')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('email_address')->nullable();
            $table->string('contact_during_application')->nullable();
            $table->string('main_address_uk')->nullable();
            $table->string('ownership_status')->nullable();
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('contact_details');
    }
}
