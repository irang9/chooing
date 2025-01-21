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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // 이름은 필수
            $table->string('phone')->nullable(); // 전화번호는 선택
            $table->string('company_phone')->nullable(); // 회사 전화번호는 선택
            $table->string('email')->nullable(); // 이메일은 선택
            $table->date('hire_date')->nullable(); // 입사일은 선택
            $table->enum('status', ['선택', '재직', '외주', '퇴사', '기타'])->default('선택'); // 재직 상태 선택
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
