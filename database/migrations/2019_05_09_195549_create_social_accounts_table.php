<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_account', function (Blueprint $table) {
            $table->bigIncrements('acc_id');
            $table->bigInteger('acc_user')->unsigned();
            $table->foreign('acc_user')->references('user_id')->on('user');
            $table->string('acc_providerId',255)->nullable();
            $table->string('acc_provider',255)->nullable();
            $table->string('acc_token',511)->nullable();
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
        Schema::dropIfExists('social_account');
    }
}
