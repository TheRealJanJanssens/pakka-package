<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collections', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('status')->default(0);
            $table->unsignedInteger('position');
            $table->string('name', 100);
            $table->string('description', 100);
            $table->string('slug', 100)->default('');
            $table->string('sort_order', 100);
            $table->unsignedInteger('type');
            $table->unsignedInteger('match')->nullable();
            $table->dateTime('created_at');
            $table->string('created_by')->default('');
            $table->dateTime('updated_at');
            $table->string('updated_by')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collections');
    }
}
