<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFashionCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fashion_companies', function (Blueprint $table) {
            $table->id();
            $table->string("reference");
            $table->string("ip_type");
            $table->string("application");
            $table->string("application_numbers");
            $table->string("application_filing_date");
            $table->string("patent_numbers");
            $table->string("grant_date");
            $table->string("country");
            $table->dateTime("due_date");
            $table->dateTime("last_instruction_date");
            $table->string("action_type");
            $table->string("estimated_cost");
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
        Schema::dropIfExists('fashion_companies');
    }
}
