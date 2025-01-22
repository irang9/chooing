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
        Schema::table('employees', function (Blueprint $table) {
            if (!Schema::hasColumn('employees', 'company_phone')) {
                $table->string('company_phone')->nullable();
            }
            if (!Schema::hasColumn('employees', 'hire_date')) {
                $table->date('hire_date')->nullable();
            }
            if (!Schema::hasColumn('employees', 'status')) {
                $table->string('status')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            if (Schema::hasColumn('employees', 'company_phone')) {
                $table->dropColumn('company_phone');
            }
            if (Schema::hasColumn('employees', 'hire_date')) {
                $table->dropColumn('hire_date');
            }
            if (Schema::hasColumn('employees', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
