<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('site_name')->unique();
            $table->string('site_category')->nullable();
            $table->integer('site_rank')->unsigned();
            $table->integer('room_no')->unsigned();
            $table->string('location_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('site_description')->nullable();
            $table->string('photo')->nullable();
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
        Schema::dropIfExists('sites');
    }
}
