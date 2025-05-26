<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSpousePartnersNotAccompanyingDetailsTable extends Migration
{
    public function up()
    {
        Schema::table('spouse_partners_not_accompanying_details', function (Blueprint $table) {
            // Drop unused column
            $table->dropColumn('mother_dob');

            // Ensure all relevant columns are correct type and nullable
            $table->string('spouse_given_name')->nullable()->change();
            $table->string('spouse_family_name')->nullable()->change();
            $table->string('spouse_passport_number')->nullable()->change();
            $table->string('spouse_location')->nullable()->change();
            $table->date('spouse_dob')->nullable()->change();
            $table->string('spouse_nationality')->nullable()->change();
            $table->string('spouse_accompanying_uk')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('spouse_partners_not_accompanying_details', function (Blueprint $table) {
            $table->date('mother_dob')->nullable();

            // Optionally revert changes if needed
            $table->string('spouse_given_name')->nullable(false)->change();
            $table->string('spouse_family_name')->nullable(false)->change();
            $table->string('spouse_passport_number')->nullable(false)->change();
            $table->string('spouse_location')->nullable(false)->change();
            $table->date('spouse_dob')->nullable(false)->change();
            $table->string('spouse_nationality')->nullable(false)->change();
            $table->string('spouse_accompanying_uk')->nullable(false)->change();
        });
    }
}

