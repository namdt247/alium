<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_detail', function (Blueprint $table) {
            $table->string('od_id',255);
            $table->bigInteger('od_order')->unsigned();
            $table->foreign('od_order')->references('od_id')->on('order');
            $table->integer('od_type')->default(0)->nullable();
            $table->string('od_name',255)->nullable();
            $table->integer('od_quantity')->default(0)->nullable();
            $table->bigInteger('od_assigneeTo')->default(0)->nullable();
            $table->double('od_price')->default(0)->nullable();
            $table->double('od_priceNow')->default(0)->nullable();
            $table->string('od_coupon',255)->nullable();
            $table->bigInteger('od_parent')->default(0)->nullable();
            $table->double('od_priceUnit')->default(0)->nullable();
            $table->integer('od_priority')->default(0)->nullable();
            $table->tinyInteger('od_status')->default(1)->nullable();
            $table->string('od_image',1023)->nullable();
            $table->longText('od_detail')->nullable();
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
        Schema::dropIfExists('order_detail');
    }
}
