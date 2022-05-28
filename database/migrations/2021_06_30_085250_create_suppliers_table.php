<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('supplier_name')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('position')->nullable();
            $table->integer('phone')->unsigned();
            $table->integer('tin')->unsigned();
            $table->integer('vrn')->unsigned();
            $table->string('email')->unique();
            $table->string('address')->nullable();
            $table->integer('from');
            $table->integer('to');
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
        Schema::dropIfExists('suppliers');
    }
}
