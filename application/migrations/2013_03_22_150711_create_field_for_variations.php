<?php

class Create_Field_For_Variations {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('snippets', function($table){
			$table->string('variation')->default('default');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('snippets', function($table){
			$table->drop_column('variation');
		});
	}

}