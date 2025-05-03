<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUkVisaHistoryDetailsTable extends Migration
{
    public function up()
    {
        // UK Visa History Details table
        Schema::create('uk_visa_history_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->string('visa_type')->nullable();
            $table->date('visa_valid_from')->nullable();
            $table->date('visa_expiry_date')->nullable();
            $table->string('visa_reference_number')->nullable();
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('uk_visa_history_details');
    }
}
