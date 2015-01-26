<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table)
	    {
	        $table->increments('id');
	        $table->string('email')->unique();
	        $table->string('username')->unique();
	        $table->string('password');
	        $table->boolean('locked');
	        $table->integer('userLevel'); //1 for normal user, 2 for admin and up
	        $table->rememberToken();
	        $table->string('token')->nullable();
	        $table->dateTime('last_sign_in')->default("0000-00-00 00:00:00");
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
		Schema::drop('users');
	}

}
