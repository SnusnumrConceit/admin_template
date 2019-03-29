<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatisticUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistic_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('total')
                ->comment('total users');
            $table->integer('today')
                ->comment('current day users');
            $table->date('date')
                ->comment('day of record');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statistic_users');
    }
}
