<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormDetailsTables extends Migration
{
    public function up()
    {
      

        // References table
        Schema::create('references', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->string('position')->nullable();
            $table->string('relationship')->nullable();
            $table->string('duration')->nullable();
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('references');
    }
}
