<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOverseasTravelHistoryDetailsTable extends Migration
{
    public function up()
    {
        // Students table
        Schema::create('overseas_travel_history_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->string('uk_country_visited')->nullable();
            $table->date('uk_date_arrived')->nullable();
            $table->string('intended_course')->nullable();
            $table->string('firstname')->nullable();
            $table->string('middlename')->nullable();
            $table->string('surname')->nullable();
            $table->string('nickname')->nullable();
            $table->string('uk_purpose_of_visit')->nullable();
            $table->string('uk_length_of_stay')->nullable();
            $table->string('europe_country_visited')->nullable();
            $table->date('europe_date_arrived')->nullable();
            $table->string('europe_purpose_of_visit')->nullable();
            $table->string('europe_length_of_stay')->nullable();
            $table->string('acnz_usa_country_visited')->nullable();
            $table->string('acnz_usa_date_arrived')->nullable();
            $table->string('acnz_usa_purpose_of_visit')->nullable();
            $table->string('acnz_usa_length_of_stay')->nullable();
            $table->string('row_country_visited')->nullable();
            $table->date('row_date_arrived')->nullable();
            $table->string('row_purpose_of_visit')->nullable();
            $table->string('row_length_of_stay')->nullable();
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('overseas_travel_history_details');
       
    }
}
