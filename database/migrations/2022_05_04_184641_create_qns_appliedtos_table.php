<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQnsAppliedtosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qns_appliedtos', function (Blueprint $table) {
        $table->bigIncrements('id');
         $table->string('metaname_id')->nullable();
         $table->string('indicator_id')->nullable();         
            $table->string('status')->default('Active');
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
        Schema::dropIfExists('qns_appliedtos');
    }
}
