<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_tran', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_prd_id')->unsigned();
            $table->string('prd_name',255)->nullable();
            $table->string('prd_alias',255)->nullable();
            $table->string('prd_sapo',1023)->nullable();
            $table->text('prd_des')->nullable();
            $table->text('prd_spec')->nullable();

            $table->string('locale')->index();
            $table->unique(['product_prd_id','locale']);
            $table->foreign('product_prd_id')->references('prd_id')
                ->on('product')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_tran');
    }
}
