<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierWalletSummuriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_wallet_summuries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('supplier_id')->unsigned();
            $table->integer('wallet_id')->unsigned();
            $table->integer('order_id')->default(0);
            $table->integer('wallet_amount')->default(0);
            $table->integer('wallet_balance')->default(0);
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
        Schema::dropIfExists('supplier_wallet_summuries');
    }
}
