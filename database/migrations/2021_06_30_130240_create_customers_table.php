<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('customer_name')->nullable();
            $table->string('company_name')->nullable();
            $table->integer('tin')->unsigned();
            $table->integer('vrn')->unsigned();
            $table->string('email')->nullable();
            $table->integer('phone')->unsigned();
            $table->string('location')->nullable();
            $table->integer('from');
            $table->integer('to');
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
        Schema::dropIfExists('customers');
    }
}
