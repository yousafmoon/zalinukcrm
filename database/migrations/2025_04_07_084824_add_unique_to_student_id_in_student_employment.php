<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Check for duplicates before adding unique constraint
        $duplicates = DB::table('student_employment')
            ->select('student_id')
            ->groupBy('student_id')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        if ($duplicates->isEmpty()) {
            // Add unique constraint if no duplicates
            Schema::table('student_employment', function (Blueprint $table) {
                $table->unique('student_id');
            });
        } else {
            // Handle duplicates (log or throw error, etc.)
            throw new \Exception("There are duplicate student_ids in the student_employment table.");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_employment', function (Blueprint $table) {
            $table->dropUnique(['student_id']);
        });
    }
};
