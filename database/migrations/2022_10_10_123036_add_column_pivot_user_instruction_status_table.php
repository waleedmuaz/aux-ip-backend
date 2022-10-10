<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPivotUserInstructionStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('instructors_user_pivot', function($table) {
            $table->enum('status', ['pending', 'done','cancel'])->default('pending');
        });
        Schema::table('instruction_logs', function($table) {
            $table->enum('status', ['pending', 'done','cancel'])->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('instructors_user_pivot', function($table) {
            $table->dropColumn('extra_detail_content');
        });
        Schema::table('instruction_logs', function($table) {
            $table->enum('status', ['pending', 'done','cancel'])->default('pending');
        });
    }
}
