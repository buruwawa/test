<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiablityValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liablity_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('payable_supplier')->unsigned();
            $table->bigInteger('expenses')->unsigned();
            $table->bigInteger('advance_paid_by_customer')->unsigned();
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
        Schema::dropIfExists('liablity_values');
    }
}
