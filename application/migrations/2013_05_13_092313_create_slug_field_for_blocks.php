<?php

class Create_Slug_Field_For_Blocks {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('blocks', function($table){
			$table->string('slug');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('blocks', function($table){
			$table->drop_column('slug');
		});
	}

}