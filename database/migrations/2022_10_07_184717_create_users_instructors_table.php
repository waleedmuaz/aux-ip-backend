<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersInstructorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructors_user_pivot', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('fashion_company_id');
            $table->string('instruction_applied_date');
            $table->string('instruction_array');
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
        Schema::dropIfExists('users_instructors');
    }
}
