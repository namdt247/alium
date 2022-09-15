<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->bigIncrements('od_id');
            $table->string('od_code',255)->nullable();
            $table->string('od_name',255)->nullable();
            $table->string('od_locationId',255)->nullable();
            $table->string('od_phone',255)->nullable();
            $table->string('od_email',255)->nullable();
            $table->integer('od_country')->default(0);
            $table->integer('od_city')->default(0);
            $table->integer('od_district')->default(0);
            $table->string('od_address',255)->nullable();
            $table->integer('od_postalCode')->default(0);
            $table->integer('od_quantity')->default(0);
            $table->integer('od_quality')->default(0);
            $table->bigInteger('od_product')->default(0);
            $table->double('od_templatePrice')->default(0);
            $table->bigInteger('od_createdBy')->unsigned();
            $table->foreign('od_createdBy')->references('user_id')->on('user');
            $table->bigInteger('od_assigneeTo')->default(0)->nullable();
            $table->integer('od_status')->default(0)->nullable();
            $table->double('od_priceUnit')->default(0)->nullable();
            $table->double('od_total')->default(0)->nullable();
            $table->double('od_paid')->default(0)->nullable();
            $table->string('od_requiredType',255)->nullable();
            $table->double('od_wantedPrice')->default(0);
            $table->string('od_paymentMethod',255)->nullable();
            $table->string('od_coupon',255)->nullable();
            $table->bigInteger('od_parent')->default(0)->nullable();
            $table->integer('od_type')->default(0)->nullable();
            $table->longText('od_message')->nullable();
            $table->longText('od_content')->nullable();
            $table->date('od_requiredDate')->nullable();
            $table->dateTime('od_deliveredTime')->nullable();
            $table->bigInteger('od_sale')->unsigned()->default(0)->nullable();
            $table->bigInteger('od_supplier')->unsigned()->default(0)->nullable();
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
        Schema::dropIfExists('order');
    }
}
