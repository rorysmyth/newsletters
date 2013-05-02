<?php

class Create_Table_For_Feature_Requests {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bugs', function($table){
			$table->increments('id');
			$table->string('title');
			$table->integer('priority');
			$table->text('description');
			$table->string('status')->default('unresolved');
			$table->timestamps();
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('bugs');
	}

}