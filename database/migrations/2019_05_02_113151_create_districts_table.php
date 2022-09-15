<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('district', function (Blueprint $table) {
            $table->increments('dt_id');
            $table->string('dt_code',31)->nullable();
            $table->string('dt_name',255)->nullable();
            $table->string('dt_alias',255)->nullable();
            $table->integer('dt_city')->unsigned();
            $table->foreign('dt_city')->references('city_id')->on('city');
            $table->integer('dt_order')->default(0);
            $table->tinyInteger('dt_status')->default(1);
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
        Schema::dropIfExists('district');
    }
}
