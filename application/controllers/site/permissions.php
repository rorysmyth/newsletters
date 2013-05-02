<?php

class Site_Permissions_Controller extends Site_Controller
{
	public function action_index()
	{
		$permissions = \Verify\Models\Permission::all();
		return View::make('site.permissions.index')
			->with('permissions', $permissions);
	}
	public function action_new()
	{
		return View::make('site.permissions.new');
	}
	public function action_edit($id)
	{
		$permission = \Verify\Models\Permission::find($id);
		return View::make('site.permissions.edit')
			->with('permission', $permission);
	}
}