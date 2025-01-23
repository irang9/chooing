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
        Schema::table('staff', function (Blueprint $table) {
            $table->string('phone')->nullable()->change();
            $table->string('company_phone')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->date('hire_date')->nullable()->change();
            $table->string('status')->nullable()->change();
            $table->string('position')->nullable()->change();
            $table->date('birthday')->nullable()->change();
            $table->string('extension')->nullable()->change();
            $table->text('memo')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('staff', function (Blueprint $table) {
            $table->string('phone')->nullable(false)->change();
            $table->string('company_phone')->nullable(false)->change();
            $table->string('email')->nullable(false)->change();
            $table->date('hire_date')->nullable(false)->change();
            $table->string('status')->nullable(false)->change();
            $table->string('position')->nullable(false)->change();
            $table->date('birthday')->nullable(false)->change();
            $table->string('extension')->nullable(false)->change();
            $table->text('memo')->nullable(false)->change();
        });
    }
};
