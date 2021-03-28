<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasswordResetsTable extends Migration
{
    public function up()
    {
        Schema::create('password_resets', function (Blueprint $table) {

		$table->string('email',191);
		$table->string('token',191);
		$table->timestamp('created_at')->nullable()->default('NULL');

        });
    }

    public function down()
    {
        Schema::dropIfExists('password_resets');
    }
}