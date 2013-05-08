<?php

class Insert_Data_For_Permissions {

	public $data = array(
		'add_newsletters',
		'add_snippets',
		'create_bugs',
		'create_permissions',
		'create_roles',
		'create_sites',
		'create_templates',
		'create_variations',
		'delete_snippets',
		'delete_variations',
		'download_documents',
		'duplicate_newsletters',
		'edit_newsletters',
		'edit_permissions',
		'edit_permissions',
		'edit_roles',
		'edit_sites',
		'edit_snippets',
		'edit_templates',
		'edit_users',
		'view_bugs',
		'view_newsletters',
		'view_permissions',
		'view_permissions',
		'view_roles',
		'view_sites',
		'view_templates',
		'view_variations'
	);
	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		foreach ($this->data as $permission) {
			DB::table('verify_permissions')->insert(array('name' => $permission));
		}
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		foreach ($this->data as $permission) {
			DB::table('verify_permissions')
				->where('name', '=', $permission)
				->delete();
		}
	}

}