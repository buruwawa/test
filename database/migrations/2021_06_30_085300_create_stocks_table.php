<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('item')->nullable();
            $table->string('unit')->nullable();
            $table->string('material_code')->nullable();
            $table->integer('price')->unsigned();
            $table->integer('selling_price')->unsigned();
            $table->integer('stock_alert')->default(0);
            $table->float('vat')->default(0);
            $table->string('descriptions')->nullable();
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
        Schema::dropIfExists('stocks');
    }
}
