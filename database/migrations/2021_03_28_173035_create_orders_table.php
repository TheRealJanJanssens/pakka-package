<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 25)->default('');
            $table->text('note')->nullable();
            $table->text('instructions')->nullable();
            $table->unsignedInteger('financial_status')->default(0);
            $table->unsignedInteger('fulfillment_status')->default(0);
            $table->integer('coupon_id')->nullable();
            $table->unsignedInteger('taxes_included')->default(1);
            $table->unsignedInteger('cancel_reason')->default(0);
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->timestamp('closed_at');
            $table->timestamp('cancelled_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
