<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsPhoneDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_phone_detail', function (Blueprint $table) {
            $table->bigIncrements('phone_detail_id');
            $table->bigInteger('phone_id');
            $table->string('color');
            $table->string('memory');
            $table->string('storage');
            $table->integer('stock');
            $table->bigInteger('price');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();

            $table->foreign('phone_id')->references('phone_id')->on('ms_phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ms_phone_detail');
    }
}
