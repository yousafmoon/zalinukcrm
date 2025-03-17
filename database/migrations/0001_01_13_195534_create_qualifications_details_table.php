<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQualificationsDetailsTable extends Migration
{
    public function up()
    {

        // Qualifications Details table
        Schema::create('qualifications_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->string('qualifications')->nullable();
            $table->string('study_institution')->nullable();
            $table->string('subjects_studied')->nullable();
            $table->date('date_passed')->nullable();
            $table->string('study_gap_after_last_degree')->nullable();
            $table->string('can_you_justify_gap')->nullable();
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('qualifications_details');
    }
}
