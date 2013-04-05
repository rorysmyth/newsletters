<?php

class Create_Relation_Between_Snippets_And_Variations {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('snippets', function($table){
			$table->integer('variation_id')->unsigned()->nullable();
			$table->foreign('variation_id')->references('id')->on('variations');
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
			$table->drop_column('variation_id');
		});
	}

}