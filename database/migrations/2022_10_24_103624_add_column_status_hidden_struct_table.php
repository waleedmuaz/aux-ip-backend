<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnStatusHiddenStructTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('structure_col_for_instruction', function($table) {
            $table->boolean('hidden')->default(0);
            $table->boolean('editable_col')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('structure_col_for_instruction', function($table) {
            $table->dropColumn('hidden');
            $table->dropColumn('editable_col');
        });
    }
}
