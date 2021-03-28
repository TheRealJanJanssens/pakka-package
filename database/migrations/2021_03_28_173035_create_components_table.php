<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('components', function (Blueprint $table) {
            $table->string('id', 10)->default('')->primary();
            $table->unsignedInteger('page_id');
            $table->unsignedInteger('section_id');
            $table->unsignedInteger('position');
            $table->string('slug', 191)->default('');
            $table->string('name', 191)->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('components');
    }
}
