<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCateArticleTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cate_article_tran', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cate_article_cate_id')->unsigned();
            $table->string('cate_value',255)->nullable();
            $table->string('cate_alias',255)->nullable();

            $table->string('locale')->index();
            $table->unique(['cate_article_cate_id','locale']);
            $table->foreign('cate_article_cate_id')->references('cate_id')
                ->on('cate_article')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cate_article_tran');
    }
}
