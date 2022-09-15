<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cate_product', function (Blueprint $table) {
            $table->increments('cate_id');
            $table->string('cate_name',255)->nullable();
            $table->string('cate_value',255)->nullable();
            $table->string('cate_code')->nullable();
            $table->integer('cate_parent')->default(0);
            $table->string('cate_alias',255)->nullable();
            $table->longText('cate_size')->nullable();
            $table->string('cate_featureImg',255)->nullable();
            $table->tinyInteger('cate_status')->default(1);
            $table->integer('cate_order')->default(0)->nullable();
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
        Schema::dropIfExists('cate_product');
    }
}
