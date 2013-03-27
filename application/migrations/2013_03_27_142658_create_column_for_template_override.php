<?php

class Create_Column_For_Template_Override {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('newsletters', function($table){
			$table->boolean('template_override');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('newsletters', function($table){
			$table->drop_column('template_override');
		});
	}

}