<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('order_id', 25)->default('');
            $table->string('product_id', 25)->nullable()->default('');
            $table->string('sku', 90)->nullable()->default('');
            $table->string('name')->nullable();
            $table->float('price', 10, 0)->nullable()->default(0);
            $table->float('quantity', 10, 0)->nullable()->default(0);
            $table->unsignedInteger('weight')->nullable()->default(0);
            $table->unsignedInteger('vat')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
