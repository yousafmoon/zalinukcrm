<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpousePartnersNotAccompanyingDetailsTable extends Migration
{
    public function up()
    {
        // Spouse or Partners Not Accompanying table
        Schema::create('spouse_partners_not_accompanying_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->string('spouse_given_name')->nullable();
            $table->string('spouse_family_name')->nullable();
            $table->string('spouse_passport_number')->nullable();
            $table->string('spouse_location')->nullable();
            $table->date('spouse_dob')->nullable();
            $table->string('spouse_nationality')->nullable();
            $table->date('mother_dob')->nullable();
            $table->string('spouse_accompanying_uk')->nullable();
            $table->timestamps();
        });

    }

    public function down()
    {
  
        Schema::dropIfExists('spouse_partners_not_accompanying_details');
    }
}
