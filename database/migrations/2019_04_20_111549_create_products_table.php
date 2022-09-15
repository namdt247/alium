<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->bigIncrements('prd_id');
            $table->string('prd_name',255)->nullable();
            $table->string('prd_alias',255)->nullable();
            $table->string('prd_sapo',1023)->nullable();
            $table->string('prd_SKU',255)->nullable();
            $table->text('prd_des')->nullable();
            $table->longText('prd_spec')->nullable();
            $table->double('prd_price',15,0)->default(-1)->nullable();
            $table->double('prd_priceNow',15,0)->default(-1)->nullable();
            $table->integer('prd_quantity')->unsigned()->default(1);
            $table->string('prd_code',255)->nullable();
            $table->integer('prd_sold')->unsigned()->default(0);
            $table->integer('prd_view')->unsigned()->default(0);
            $table->integer('prd_cate')->unsigned();
            $table->foreign('prd_cate')->references('cate_id')->on('cate_product');
            $table->integer('prd_type')->default(1);
            $table->string('prd_tag',255)->nullable();
            $table->tinyInteger('prd_status')->default(1);
            $table->integer('prd_order')->default(0);
            $table->tinyInteger('prd_promote')->default(0);
            $table->string('prd_featureImg',255)->nullable();
            $table->bigInteger('prd_createdBy')->unsigned();
            $table->foreign('prd_createdBy')->references('user_id')->on('user');
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
        Schema::dropIfExists('product');
    }
}
