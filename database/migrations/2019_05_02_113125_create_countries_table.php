<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country', function (Blueprint $table) {
            $table->increments('cty_id');
            $table->string('cty_code',31)->nullable();
            $table->string('cty_languageCode',255)->nullable();
            $table->string('cty_langName',255)->nullable();
            $table->string('cty_name',255)->nullable();
            $table->string('cty_alias',255)->nullable();
            $table->string('cty_phoneCode',255)->nullable();
            $table->string('cty_numbericCode',255)->nullable();
            $table->integer('cty_order')->default(0);
            $table->tinyInteger('cty_status')->default(1);
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
        Schema::dropIfExists('country');
    }
}
