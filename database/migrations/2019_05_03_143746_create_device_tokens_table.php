<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeviceTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_token', function (Blueprint $table) {
            $table->bigInteger('token_user')->unsigned();
            $table->foreign('token_user')->references('user_id')->on('user');
            $table->string('token_device',1023)->nullable();
            $table->string('token_value',1023)->nullable();
            $table->string('token_push',1023)->nullable();
            $table->timestamp('token_expire')->nullable();
            $table->timestamp('token_lastLogin')->nullable();
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
        Schema::dropIfExists('device_token');
    }
}
