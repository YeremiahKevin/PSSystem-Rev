<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrTransactionDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_transaction_detail', function (Blueprint $table) {
            $table->bigIncrements('transaction_detail_id');
            $table->bigInteger('transaction_header_id');
            $table->bigInteger('phone_detail_id');
            $table->integer('quantity');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();

            $table->foreign('transaction_header_id')->references('transaction_header_id')->on('tr_transaction_header');
            $table->foreign('phone_detail_id')->references('phone_detail_id')->on('ms_phone_detail');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tr_transaction_detail');
    }
}
