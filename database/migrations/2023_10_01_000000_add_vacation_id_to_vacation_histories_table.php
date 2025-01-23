<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vacation_histories', function (Blueprint $table) {
            $table->unsignedBigInteger('vacation_id')->after('id');
            $table->foreign('vacation_id')->references('id')->on('vacations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vacation_histories', function (Blueprint $table) {
            $table->dropForeign(['vacation_id']);
            $table->dropColumn('vacation_id');
        });
    }
};