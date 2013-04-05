<?php

class Make_Table_For_Users {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table){
			$table->increments('id');
			$table->string('username', 128);
			$table->string('password', 64);
		});

		DB::table('users')->insert(array(
			'username' => 'admin',
			'password' => Hash::make('Phone!!1')
		));
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}