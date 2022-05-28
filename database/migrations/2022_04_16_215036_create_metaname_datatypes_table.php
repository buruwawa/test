<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetanameDatatypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metaname_datatypes', function (Blueprint $table) {
          $table->bigIncrements('id');
            $table->string('metaname_id')->nullable();
            $table->string('metadata_name')->nullable();
            $table->string('datatype')->nullable();
            $table->string('datatype_name')->unique();
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
        Schema::dropIfExists('metaname_datatypes');
    }
}
