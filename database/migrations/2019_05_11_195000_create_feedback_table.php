<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->bigIncrements('fb_id');
            $table->string('fb_code',255)->nullable();
            $table->string('fb_email',255)->nullable();
            $table->string('fb_phone',255)->nullable();
            $table->string('fb_name',255)->nullable();
            $table->bigInteger('fb_order')->default(0)->nullable();
            $table->integer('fb_cate')->default(0)->nullable();
            $table->bigInteger('fb_user')->default(0)->nullable();
            $table->text('fb_content')->nullable();
            $table->bigInteger('fb_assignee')->default(0)->nullable();
            $table->integer('fb_status')->default(1)->nullable();
            $table->text('fb_note')->nullable();
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
        Schema::dropIfExists('feedback');
    }
}
