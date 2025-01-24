<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('vacations', function (Blueprint $table) {
        // 이미 존재하는 경우를 확인 후 컬럼 추가
        if (!Schema::hasColumn('vacations', 'staff_id')) {
            $table->unsignedBigInteger('staff_id')->nullable();
        }

        // 새 컬럼 추가
        if (!Schema::hasColumn('vacations', 'new_column')) {
            $table->string('new_column')->nullable();
        }
    });
}

public function down()
{
    Schema::table('vacations', function (Blueprint $table) {
        // 추가된 컬럼 제거
        if (Schema::hasColumn('vacations', 'staff_id')) {
            $table->dropForeign(['staff_id']); // 외래 키 제거
            $table->dropColumn('staff_id');
        }

        if (Schema::hasColumn('vacations', 'new_column')) {
            $table->dropColumn('new_column');
        }
    });
}
};
