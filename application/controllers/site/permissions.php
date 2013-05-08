<?php

class Site_Permissions_Controller extends Site_Controller
{
	public function action_index()
	{
		if(!Auth::can('view_permissions'))
        {
            return View::make('site.errors.permissions')
                ->with('alert', "you aren't allowed to view permissions");
        }
		$permissions = \Verify\Models\Permission::all();
		return View::make('site.permissions.index')
			->with('permissions', $permissions);
	}
	public function action_new()
	{
		if(!Auth::can('create_permissions'))
        {
            return View::make('site.errors.permissions')
                ->with('alert', "you aren't allowed to create permissions");
        }
		return View::make('site.permissions.new');
	}
	public function action_edit($id)
	{
		if(!Auth::can('edit_permissions'))
        {
            return View::make('site.errors.permissions')
                ->with('alert', "you aren't allowed to edit permissions");
        }
		$permission = \Verify\Models\Permission::find($id);
		return View::make('site.permissions.edit')
			->with('permission', $permission);
	}
}