<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOldValueToEditHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('edit_histories', function (Blueprint $table) {
            if (!Schema::hasColumn('edit_histories', 'old_value')) {
                $table->text('old_value')->nullable()->after('field');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('edit_histories', function (Blueprint $table) {
            if (Schema::hasColumn('edit_histories', 'old_value')) {
                $table->dropColumn('old_value');
            }
        });
    }
}
