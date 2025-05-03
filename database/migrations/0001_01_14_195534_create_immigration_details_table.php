<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImmigrationDetailsTable extends Migration
{
    public function up()
    {


        // Immigration Details table
        Schema::create('immigration_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->string('travel_outside')->nullable();
            $table->string('travel_uk')->nullable();
            $table->string('refused_uk_visa')->nullable();
            $table->string('refused_any_visa')->nullable();
            $table->string('granted_uk_visa')->nullable();
            $table->string('refused_entry_uk')->nullable();
            $table->string('deported_uk')->nullable();
            $table->string('deported_other_country')->nullable();
            $table->string('applied_home_office')->nullable();
            $table->string('breach_immigration_conditions')->nullable();
            $table->string('criminal_convictions')->nullable();
            $table->string('charged_criminal_offence')->nullable();
            $table->string('involved_in_war_crimes')->nullable();
            $table->string('involved_in_terrorism')->nullable();
            $table->string('activities_bad_character')->nullable();
            $table->string('nhs_treatment_unpaid')->nullable();
            $table->string('organization_type')->nullable();
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('immigration_details');
    }
}
