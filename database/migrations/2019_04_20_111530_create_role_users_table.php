<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * @var Blueprint $table
     */
    public function up()
    {

        Schema::create('role_user', function (Blueprint $table) {
            $table->increments('role_id');
            $table->string('role_name',255)->nullable();
            $table->string('role_value',255)->nullable();
            $table->string('role_des',1023)->nullable();
            $table->tinyInteger('role_status')->unsigned()->default(1)->nullable();
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
        Schema::dropIfExists('role_user');
    }
}
