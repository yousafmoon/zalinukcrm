<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id(); 
        
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');

            $table->string('document_type')->nullable(); 
            $table->string('file_name');                
            $table->string('original_name');            
            $table->text('file_path');                                   

            $table->timestamp('uploaded_at')->nullable();    
            $table->timestamps();                            
        });
    }

    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
