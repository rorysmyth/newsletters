<?php

class Site_Roles_Controller extends Site_Controller
{
	public function action_index()
	{
		$roles = \Verify\Models\Role::all();
		return View::make('site.roles.index')
			->with('roles', $roles);
	}

	public function action_new()
	{
		return View::make('site.roles.new');
	}
	public function action_edit($id)
	{
		$role        = \Verify\Models\Role::find($id);
		$permissions = \Verify\Models\Permission::all();

		$granted = array();
		foreach($role->permissions()->pivot()->get() as $permission)
		{
			array_push($granted, $permission->permission_id);
		}
		// dd($granted);

		return View::make('site.roles.edit')
			->with('role', $role)
			->with('permissions', $permissions)
			->with('granted', $granted);
	}
}