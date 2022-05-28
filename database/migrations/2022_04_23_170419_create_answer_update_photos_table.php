<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerUpdatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_update_photos', function (Blueprint $table) {
         $table->bigIncrements('id');
         $table->integer('index_id')->nullable();
         $table->integer('answer_id')->nullable();
            $table->string('description',250)->nullable();
           $table->string('image',120)->nullable();
            $table->string('status')->default('Active');
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
        Schema::dropIfExists('answer_update_photos');
    }
}
