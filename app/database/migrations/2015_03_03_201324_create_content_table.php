<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('content', function($table)
	    {
	        $table->increments('id');
	        $table->string('uid');
	        $table->string('page');
	        $table->string('content')->default("");
	        $table->string('language')->default("en");
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
		Schema::dropIfExists('content');
	}

}
