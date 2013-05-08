<?php

class Insert_Data_For_Roles {

	public $data = array(
		"Designer",
		"Copywriter"
	);
	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		foreach ($this->data as $role) {
			DB::table('verify_roles')->insert(array('name' => $role));
		}
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		foreach ($this->data as $role) {
			DB::table('verify_roles')
				->where('name', '=', $role)
				->delete();
		}
	}

}