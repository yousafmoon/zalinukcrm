<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckCopyDetailsTable  extends Migration
{
    public function up()
    {
        // Check Copy Details table
        Schema::create('check_copy_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->boolean('copy_current_passport')->nullable();
            $table->boolean('copy_any_current_previous_uk_visas')->nullable();
            $table->boolean('copy_any_previous_passports')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();
        });       
    }

    public function down()
    {
        Schema::dropIfExists('check_copy_details');
    }
}
