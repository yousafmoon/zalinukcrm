<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        // Create overseas_travel_regions table
        Schema::create('overseas_travel_regions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->string('region_title')->nullable();
            $table->timestamps();
        });

        // Create overseas_travel_visits table
        Schema::create('overseas_travel_visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('region_id')->constrained('overseas_travel_regions')->onDelete('cascade');
            $table->string('country_visited')->nullable();
            $table->date('date_arrived')->nullable();
            $table->string('purpose_of_visit')->nullable();
            $table->string('length_of_stay')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('overseas_travel_visits');
        Schema::dropIfExists('overseas_travel_regions');
    }
};
