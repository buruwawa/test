<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
         $table->bigIncrements('id');
         $table->string('indicator_id')->nullable();
           $table->string('answer')->nullable();
           $table->string('property_id')->nullable();
           $table->string('description',250)->nullable();
           $table->string('image',120)->nullable();
            $table->string('status')->default('Active');
            $table->string('action')->default(0);
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
        Schema::dropIfExists('answers');
    }
}
