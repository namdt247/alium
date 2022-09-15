<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCateProductTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cate_product_tran', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cate_product_cate_id')->unsigned();
            $table->string('cate_value',255)->nullable();
            $table->string('cate_alias',255)->nullable();
            $table->longText('cate_size')->nullable();

            $table->string('locale')->index();
            $table->unique(['cate_product_cate_id','locale']);
            $table->foreign('cate_product_cate_id')->references('cate_id')
                ->on('cate_product')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cate_product_tran');
    }
}
