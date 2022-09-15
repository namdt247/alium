<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->bigIncrements('user_id');
            $table->string('user_name',255)->nullable();
            $table->string('user_showName',255)->nullable();
            $table->string('user_alias',255)->nullable();
            $table->string('password',255)->nullable();
            $table->text('user_des')->nullable();
            $table->string('user_email',255)->nullable();
            $table->string('user_phone',255)->nullable();
            $table->string('user_avatar',255)->nullable();
            $table->integer('user_country')->default(245)->nullable();
            $table->integer('user_city')->default(0)->nullable();
            $table->integer('user_district')->default(0)->nullable();
            $table->string('user_postalCode',255)->nullable();
            $table->string('user_address',255)->nullable();
            $table->date('user_birthday')->nullable();
            $table->string('user_gender',255)->nullable();
            $table->integer('user_type')->unsigned()->default(2)->nullable();
            $table->integer('user_role')->default(11)->unsigned();
            $table->foreign('user_role')->references('role_id')->on('role_user');
            $table->tinyInteger('user_verify')->default(0)->nullable();
            $table->string('user_verifyCode',255)->nullable();
            $table->tinyInteger('user_status')->default(1)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('user');
    }
}
