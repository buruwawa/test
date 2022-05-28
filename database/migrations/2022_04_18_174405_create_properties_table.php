<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
       $table->bigIncrements('id');
         $table->string('site_id')->nullable();
          $table->string('location_id')->nullable();
           $table->string('metaname_id')->nullable();
            $table->string('property_name')->nullable();
              $table->string('property_type')->nullable();
            $table->string('property_serial_no')->nullable();
            $table->string('property_barcode')->nullable();
             $table->string('property_tag_no')->nullable();
              $table->string('property_description')->nullable();
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
        Schema::dropIfExists('properties');
    }
}
