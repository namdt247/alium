<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rating', function (Blueprint $table) {
            $table->bigIncrements('rate_id');
            $table->double('rate_star')->default(0)->nullable();
            $table->string('rate_title',255)->nullable();
            $table->text('rate_content')->nullable();
            $table->string('rate_type',255)->nullable();
            $table->string('rate_targetType',255)->nullable();
            $table->bigInteger('rate_targetId')->default(0)->nullable();
            $table->string('rate_authorType',255)->nullable();
            $table->bigInteger('rate_authorId')->default(0)->nullable();
            $table->integer('rate_status')->default(0);
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
        Schema::dropIfExists('rating');
    }
}
