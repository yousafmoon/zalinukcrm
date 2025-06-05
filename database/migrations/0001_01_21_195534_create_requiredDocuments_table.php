<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequiredDocumentsTable extends Migration
{
    public function up()
    {
        Schema::create('required_documents', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('document_id');
            $table->foreign('document_id')->references('id')->on('documents')->onDelete('cascade');

            $table->string('document_type')->nullable();    
            $table->text('description')->nullable();       

            $table->string('file_name')->nullable();        
            $table->string('original_name')->nullable();    
            $table->text('file_path')->nullable();          
            $table->timestamp('uploaded_at')->nullable();  

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('required_documents');
    }
}
