<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormDetailsTables extends Migration
{
    public function up()
    {
        // Income Details table
        Schema::create('income_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->decimal('monthly_income', 10, 2)->nullable();
            $table->decimal('income_from_others', 10, 2)->nullable();
            $table->string('other_income_sources')->nullable();
            $table->decimal('monthly_income_given_to_family', 10, 2)->nullable();
            $table->decimal('monthly_living_costs', 10, 2)->nullable();
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('income_details');
    }
}
