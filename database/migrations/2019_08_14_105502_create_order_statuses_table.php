<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_status', function (Blueprint $table) {
            $table->increments('stt_id');
            $table->string('stt_name',255)->nullable();
            $table->string('stt_valueA',255)->nullable();
            $table->string('stt_valueF',255)->nullable();
            $table->integer('stt_timeSchedule')->default(0)->nullable();
            $table->integer('stt_parent')->unsigned()->default(0)->nullable();
            $table->text('stt_action')->nullable();
            $table->text('stt_notify')->nullable();
            $table->string('stt_nameAction',255)->nullable();
            $table->integer('stt_order')->default(0)->nullable();
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
        Schema::dropIfExists('order_status');
    }
}
