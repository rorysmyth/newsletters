<?php

class Site_Roles_Controller extends Site_Controller
{
	public function action_index()
	{
		if(!Auth::can('view_roles'))
        {
            return View::make('site.errors.permissions')
                ->with('alert', "you aren't allowed to view roles");
        }
		$roles = \Verify\Models\Role::all();
		return View::make('site.roles.index')
			->with('roles', $roles);
	}

	public function action_new()
	{
		if(!Auth::can('create_roles'))
        {
            return View::make('site.errors.permissions')
                ->with('alert', "you aren't allowed to create roles");
        }
		return View::make('site.roles.new');
	}
	public function action_edit($id)
	{
		if(!Auth::can('edit_roles'))
        {
            return View::make('site.errors.permissions')
                ->with('alert', "you aren't allowed to edit roles");
        }
		$role        = \Verify\Models\Role::find($id);
		$permissions = \Verify\Models\Permission::all();

		$granted = array();
		foreach($role->permissions()->pivot()->get() as $permission)
		{
			array_push($granted, $permission->permission_id);
		}

		return View::make('site.roles.edit')
			->with('role', $role)
			->with('permissions', $permissions)
			->with('granted', $granted);
	}
}