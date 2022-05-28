<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDirectExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direct_expenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('expenses_name')->nullable();
            $table->integer('amount')->unsigned();
            $table->string('category')->nullable();
            $table->string('descriptions')->nullable();
            $table->string('status')->nullable();
            $table->integer('user_id')->unsigned();
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
        Schema::dropIfExists('direct_expenses');
    }
}
