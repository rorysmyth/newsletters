<?php

class Create_Table_For_Variatios {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('variations', function($table){

			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('title');
			$table->integer('newsletter_id')->unsigned()->nullable();;
			$table->foreign('newsletter_id')->references('id')->on('newsletters');
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
		Schema::drop('variations');
	}

}