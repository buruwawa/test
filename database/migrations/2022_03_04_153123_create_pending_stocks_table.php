<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendingStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pending_stocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('item_id')->unsigned();
            $table->integer('trans_no')->unsigned();
             $table->string('from_store')->nullable();
            $table->decimal('Qty_issued')->nullable();
            $table->string('to_store')->nullable();
               $table->decimal('Qty_received')->nullable();
            $table->string('trans_type')->nullable();
            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('pending_stocks');
    }
}
