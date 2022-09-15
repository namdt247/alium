<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_detail', function (Blueprint $table) {
            $table->bigInteger('sp_supplier')->unsigned();
            $table->foreign('sp_supplier')->references('sp_id')->on('supplier');
            $table->integer('sp_type')->default(0)->nullable();
            $table->string('sp_name',255)->nullable();
            $table->tinyInteger('sp_status')->default(1)->nullable();
            $table->string('sp_image',1023)->nullable();
            $table->longText('sp_detail')->nullable();
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
        Schema::dropIfExists('supplier_detail');
    }
}
