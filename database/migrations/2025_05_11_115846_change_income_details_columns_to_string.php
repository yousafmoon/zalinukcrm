<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::table('income_details', function (Blueprint $table) {
    $table->string('income_from_others')->nullable()->change();
    $table->string('other_income_sources')->nullable()->change();
});

    }

};
