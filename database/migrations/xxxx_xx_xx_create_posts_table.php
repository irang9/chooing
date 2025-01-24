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
        // 이미 존재하는 테이블이므로 생성하지 않음
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 이미 존재하는 테이블이므로 삭제하지 않음
    }
};
