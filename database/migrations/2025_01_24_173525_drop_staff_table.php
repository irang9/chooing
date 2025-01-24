<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::dropIfExists('staff');
}

public function down()
{
    Schema::create('staff', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('phone')->nullable();
        $table->string('company_phone')->nullable();
        $table->string('extension')->nullable();
        $table->string('email')->nullable();
        $table->date('hire_date')->nullable();
        $table->string('status')->nullable();
        $table->string('position')->nullable();
        $table->date('birthday')->nullable();
        $table->text('memo')->nullable();
        $table->time('start_time')->nullable();
        $table->time('end_time')->nullable();
        $table->decimal('work_days', 3, 1)->nullable();
        $table->timestamps();
    });
}
};
