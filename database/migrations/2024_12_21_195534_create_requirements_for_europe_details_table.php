<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormDetailsTables extends Migration
{
    public function up()
    {
        // Requirements for Europe table
        Schema::create('requirements_for_europe_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->string('do_you_have_block_account')->nullable();
            $table->string('have_you_legalised_documents')->nullable();
            $table->string('bonafide_student_undertaking')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('requirements_for_europe_details');
    }
}
