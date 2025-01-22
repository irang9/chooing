<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToVacationsTable extends Migration
{
    public function up()
    {
        Schema::table('vacations', function (Blueprint $table) {
            if (!Schema::hasColumn('vacations', 'status')) {
                $table->string('status')->default('등록됨'); // status 컬럼 추가
            }
        });
    }

    public function down()
    {
        Schema::table('vacations', function (Blueprint $table) {
            if (Schema::hasColumn('vacations', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
}
