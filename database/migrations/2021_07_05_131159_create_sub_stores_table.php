<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_stores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('warehouse')->unsigned();
            $table->string('warehouse_name')->nullable();
            $table->integer('item_id')->unsigned();
            $table->decimal('current_qty',10,2)->unsigned();
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
        Schema::dropIfExists('sub_stores');
    }
}
