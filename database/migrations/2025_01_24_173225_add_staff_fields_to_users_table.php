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
    Schema::table('users', function (Blueprint $table) {
        $table->string('company_phone')->nullable(); // 회사 전화번호
        $table->string('extension')->nullable();    // 내선 번호
        $table->date('birthday')->nullable();       // 생일
        $table->date('hire_date')->nullable();      // 입사일
        $table->time('start_time')->nullable();     // 근무 시작 시간
        $table->time('end_time')->nullable();       // 근무 종료 시간
        $table->decimal('work_days', 3, 1)->nullable(); // 근무일
        $table->text('memo')->nullable();           // 메모
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn([
            'company_phone', 'extension', 'birthday', 'hire_date',
            'start_time', 'end_time', 'work_days', 'memo'
        ]);
    });
}
};
