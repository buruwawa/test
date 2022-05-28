<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('sale_id')->unsigned();
            $table->integer('account_id')->unsigned();
            $table->integer('amount')->unsigned();
            $table->integer('paid')->unsigned();
            $table->decimal('wallet')->default(0.00);
            $table->integer('balance')->unsigned();
            $table->string('receipt')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
