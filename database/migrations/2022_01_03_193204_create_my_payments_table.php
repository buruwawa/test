<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('invoice_number')->unsigned();
            $table->integer('my_id')->unsigned();
            $table->string('package_name')->nullable();
            $table->integer('amount_paid')->unsigned();
            $table->string('end_at')->nullable();
            $table->string('start_from')->nullable();
            $table->string('paid_via')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('my_payments');
    }
}
