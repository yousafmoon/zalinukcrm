<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherInformationDetailsTable extends Migration
{
    public function up()
    {
   
        // Other Information Details table
        Schema::create('other_information_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->string('family_in_uk')->nullable();
            $table->string('travelling_with_others')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('other_information_details');
    
    }
}
