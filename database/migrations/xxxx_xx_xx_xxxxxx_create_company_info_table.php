<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_info', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('company_biz_reg_number');
            $table->string('company_ceo_name');
            $table->string('company_address');
            $table->string('company_phone');
            $table->string('company_email')->unique();
            $table->string('complaint_email')->nullable();
            $table->string('publishing_brand')->nullable();
            $table->string('publishing_phone')->nullable();
            $table->string('publishing_email')->nullable();
            $table->string('office_building')->nullable();
            $table->string('office_management')->nullable();
            $table->string('office_fire_safety')->nullable();
            $table->string('office_communication')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_info');
    }
}