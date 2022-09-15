<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->bigIncrements('pay_id');
            $table->string('pay_name',255)->nullable();
            $table->string('pay_alias',255)->nullable();
            $table->string('pay_config',255)->nullable();
            $table->tinyInteger('pay_status')->default(0);
            $table->tinyInteger('pay_type')->default(0);
            $table->string('pay_source',255)->nullable();
            $table->text('pay_content')->nullable();
            $table->string('pay_gate',255)->nullable();
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
        Schema::dropIfExists('payment');
    }
}
