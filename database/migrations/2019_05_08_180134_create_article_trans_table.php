<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_tran', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('article_atc_id')->unsigned();
            $table->string('atc_title',255)->nullable();
            $table->string('atc_alias',255)->nullable();
            $table->string('atc_sapo',1023)->nullable();
            $table->longText('atc_content')->nullable();
            $table->string('atc_source',255)->nullable();

            $table->string('locale')->index();
            $table->unique(['article_atc_id','locale']);
            $table->foreign('article_atc_id')->references('atc_id')
                ->on('article')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_tran');
    }
}
