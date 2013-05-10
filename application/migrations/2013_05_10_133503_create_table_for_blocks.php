<?php

class Create_Table_For_Blocks {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('blocks', function($table){
			$table->increments('id');
				$table->string('title');
				$table->text('code');
				$table->integer('site_id')->unsigned()->nullable();
				$table->foreign('site_id')->references('id')->on('sites');
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
		Schema::drop('blocks');
	}

}