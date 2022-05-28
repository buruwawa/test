<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stockings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('item_id')->unsigned();
            $table->decimal('qty',10,2);
            $table->decimal('current_qty',10,2)->unsigned();
            $table->integer('from')->unsigned();
            $table->integer('to')->unsigned();
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
        Schema::dropIfExists('stockings');
    }
}
