<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city', function (Blueprint $table) {
            $table->increments('city_id');
            $table->string('city_code',31);
            $table->string('city_name',127);
            $table->string('city_alias',127);
            $table->integer('city_country')->unsigned()->default(245);
            $table->foreign('city_country')->references('cty_id')->on('country');
            $table->integer('city_order')->default(0);
            $table->tinyInteger('city_status')->default(1);
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
        Schema::dropIfExists('city');
    }
}
