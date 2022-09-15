<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_image', function (Blueprint $table) {
            $table->bigIncrements('img_id');
            $table->bigInteger('img_order')->unsigned()->default(0);
            $table->string('img_src',255)->nullable();
            $table->string('img_name',255)->nullable();
            $table->string('img_alias',255)->nullable();
            $table->tinyInteger('img_status')->default(1);
            $table->tinyInteger('img_shape')->default(0);
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
        Schema::dropIfExists('order_image');
    }
}
