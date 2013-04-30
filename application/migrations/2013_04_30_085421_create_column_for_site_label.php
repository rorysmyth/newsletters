<?php

class Create_Column_For_Site_Label {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sites', function($table){
			$table->string('label',7)->default('#cccccc');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sites', function($table){
			$table->drop_column('label',7);
		});
	}

}