<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
         $table->bigIncrements('id');
         $table->integer('order_id')->unsigned();
         $table->integer('item_id')->unsigned();
              $table->decimal('width',10,2)->unsigned();
              $table->decimal('height',10,2)->unsigned();
              $table->decimal('qty',10,2)->unsigned();
            $table->integer('selling_price')->unsigned();
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
        Schema::dropIfExists('order_items');
    }
}
