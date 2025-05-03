<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsRequiredTable extends Migration
{
    public function up()
    {
        Schema::create('documents_required', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->string('file_title')->nullable();
            $table->string('file_name')->nullable();  
            $table->string('file_path')->nullable(); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('documents_required');
    }
}
