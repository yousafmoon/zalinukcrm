<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('financial_details', function (Blueprint $table) {
            $table->string('own_property')->nullable()->change();
            $table->string('bank_savings')->nullable()->change();
            $table->string('bank_funds')->nullable()->change();
            $table->string('tuition_payer')->nullable()->change();
            $table->decimal('tuition_budget', 10, 2)->nullable()->change(); 
        });
    }

    public function down()
    {
        Schema::table('financial_details', function (Blueprint $table) {
            $table->boolean('own_property')->default(false)->change();
            $table->decimal('bank_savings', 10, 2)->nullable()->change();
            $table->decimal('bank_funds', 10, 2)->nullable()->change();
            $table->string('tuition_payer')->nullable()->change();
            $table->decimal('tuition_budget', 10, 2)->nullable()->change();
        });
    }
};
