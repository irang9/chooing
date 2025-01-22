<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMemoToVacationsTable extends Migration
{
    public function up()
    {
        Schema::table('vacations', function (Blueprint $table) {
            $table->text('memo')->nullable(); // memo 컬럼 추가
        });
    }

    public function down()
    {
        Schema::table('vacations', function (Blueprint $table) {
            $table->dropColumn('memo');
        });
    }
}
