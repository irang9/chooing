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
    Schema::rename('edit_histories', 'user_histories'); // 테이블 이름 변경
}

public function down()
{
    Schema::rename('user_histories', 'edit_histories'); // 되돌릴 때 원래 이름으로
}
};
