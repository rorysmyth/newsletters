<?php

class Delete_Users_Table_For_Verify {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::drop('users');
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		//
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

}