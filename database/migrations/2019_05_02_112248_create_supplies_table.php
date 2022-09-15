<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supply', function (Blueprint $table) {
            $table->bigInteger('sp_supply')->unsigned();
            $table->foreign('sp_supply')->references('sp_id')->on('supplier');
            $table->bigInteger('sp_product')->unsigned()->default(0);
            $table->integer('sp_cate')->default(0);
            $table->integer('sp_quantity')->default(0);
            $table->tinyInteger('sp_status')->default(0);
            $table->double('sp_price')->default(0);
            $table->double('sp_priceNow')->default(0);
            $table->string("sp_coupon",1023)->nullable();
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
        Schema::dropIfExists('supply');
    }
}
