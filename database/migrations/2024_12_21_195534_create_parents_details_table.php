<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentsDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('parents_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');

            // Father's Details
            $table->string('father_given_name')->nullable();
            $table->string('father_family_name')->nullable();
            $table->date('father_date_of_birth')->nullable();
            $table->string('father_place_of_birth')->nullable();
            $table->string('father_nationality')->nullable();

            // Mother's Details
            $table->string('mother_given_name')->nullable();
            $table->string('mother_family_name')->nullable();
            $table->date('mother_date_of_birth')->nullable();
            $table->string('mother_place_of_birth')->nullable();
            $table->string('mother_nationality')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('parents_details');
    }
}
