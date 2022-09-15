<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->bigIncrements('tran_id');
            $table->string('tran_number',255)->nullable();
            $table->tinyInteger('tran_type')->unsigned()->default(1);
            $table->tinyInteger('tran_port')->unsigned()->default(1);
            $table->bigInteger('tran_order')->unsigned()->nullable();
            $table->bigInteger('tran_target')->unsigned()->default(0);
            $table->double('tran_amount')->default(0);
            $table->string('tran_message',255)->nullable();
            $table->text('tran_content')->nullable();
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
        Schema::dropIfExists('transaction');
    }
}
