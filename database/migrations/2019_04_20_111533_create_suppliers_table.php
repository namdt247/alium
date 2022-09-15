<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier', function (Blueprint $table) {
            $table->bigIncrements('sp_id');
            $table->string('sp_code',255)->nullable();
            $table->string('sp_name',255)->nullable();
            $table->string('sp_alias',255)->nullable();
            $table->bigInteger('sp_user')->default(0)->nullable();
            $table->string('sp_manager',255)->nullable();
            $table->string('sp_email',255)->nullable();
            $table->string('sp_phone',255)->nullable();
            $table->string('sp_banner',255)->nullable();
            $table->string('sp_avatar',255)->nullable();
            $table->string('sp_location',255)->nullable();
            $table->string('sp_locationId',255)->nullable();
            $table->integer('sp_city')->default(0)->nullable();
            $table->integer('sp_minQuantity')->default(0)->nullable();
            $table->integer('sp_maxQuantity')->default(0)->nullable();
            $table->integer('sp_numEmployee')->default(0)->nullable();
            $table->string('sp_archive',255)->nullable();
            $table->string('sp_qualityOrder',255)->nullable();
            $table->integer('sp_licenseId')->default(0)->nullable();
            $table->string('sp_businessLicense',1023)->nullable();
            $table->double('sp_point')->default(0)->nullable();
            $table->double('sp_rate')->default(0)->nullable();
            $table->integer('sp_numRate')->default(0)->nullable();
            $table->date('sp_init')->nullable();
            $table->string('sp_otherProduct',1023)->nullable();
            $table->string('sp_image',1023)->nullable();
            $table->text('sp_service')->nullable();
            $table->integer('sp_type')->default(0)->nullable();
            $table->integer('sp_status')->default(0)->nullable();
            $table->bigInteger('sp_createdBy')->default(0)->nullable();
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
        Schema::dropIfExists('supplier');
    }
}
