<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('supplier_id')->unsigned();
            $table->integer('warehouse_id')->unsigned();
            $table->integer('discount')->default(0);
            $table->integer('amount')->default(0);
            $table->integer('paid')->default(0);
            $table->integer('balance')->default(0);
            $table->string('status')->nullable();
            $table->string('payment')->nullable();
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
        Schema::dropIfExists('purchase_orders');
    }
}
