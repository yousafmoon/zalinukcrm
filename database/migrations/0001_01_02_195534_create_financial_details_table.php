<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancialDetailsTable  extends Migration
{
    public function up()
    {

        // Financial Details table
        Schema::create('financial_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->boolean('own_property')->default(false);
            $table->decimal('bank_savings', 10, 2)->nullable();
            $table->decimal('tuition_budget', 10, 2)->nullable();
            $table->decimal('bank_funds', 10, 2)->nullable();
            $table->string('tuition_payer')->nullable();
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('financial_details');
       
    }
}
