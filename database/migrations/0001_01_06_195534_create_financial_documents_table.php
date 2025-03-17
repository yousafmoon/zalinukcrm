<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancialDocumentsTable extends Migration
{
    public function up()
    {

        // Financial Documents table
        Schema::create('financial_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->string('document_title')->nullable();
            $table->string('document_name')->nullable();
            $table->string('document_path')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('financial_documents');
    }
}
