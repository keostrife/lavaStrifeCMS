<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
		$this->call('AdminSeeder');
		$this->call('LanguageSeeder');
	}

}

class AdminSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users')->delete();
		User::createU(array(
			'email' => 'keo.strife@babyrobot.com',
			'username' => 'admin',
			'password' => 'devPa$$word',
		));
	}

}

class LanguageSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('languages')->delete();
		$en = new Language;
		$en->name = "English";
		$en->code = "en";
		$en->save();

		$fr = new Language;
		$fr->name = "French";
		$fr->code = "fr";
		$fr->save();
	}

}

