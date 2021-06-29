<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeInputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_inputs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('input_id', 10)->nullable();
            $table->string('set_id', 10)->nullable();
            $table->integer('position')->nullable()->default(2);
            $table->char('label', 30)->nullable();
            $table->string('name')->nullable()->default('');
            $table->string('type', 10)->nullable();
            $table->unsignedInteger('required')->default(0);
            $table->string('attributes', 750)->nullable()->default(''); // (class, columns, validation,...?)
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
        Schema::dropIfExists('attribute_inputs');
    }
}
