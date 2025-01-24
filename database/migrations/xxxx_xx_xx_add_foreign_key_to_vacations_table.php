<?php 

namespace Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ForeignKeyToVacationsTable extends Migration {
    // ...existing code...

    public function up() {
        Schema::table('vacations', function (Blueprint $table) {
            // ...existing code...
        });
    }

    public function down() {
        Schema::table('vacations', function (Blueprint $table) {
            // ...existing code...
        });
    }
}
