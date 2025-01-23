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
            $table->time('start_time')->nullable()->after('memo'); // 출근 시간 필드 추가
            $table->time('end_time')->nullable()->after('start_time'); // 퇴근 시간 필드 추가
            $table->decimal('work_days', 3, 1)->nullable()->after('end_time'); // 주 근무시간 필드 추가
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('staff', function (Blueprint $table) {
            $table->dropColumn('start_time');
            $table->dropColumn('end_time');
            $table->dropColumn('work_days');
        });
    }
};
