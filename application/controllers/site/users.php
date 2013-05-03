<?php

class Site_Users_Controller extends Site_Controller
{
	public function action_index()
	{
		$users = \Verify\Models\User::with(array('roles'))->get();
		$roles = \Verify\Models\Role::all();

		return View::make('site.users.index')
			->with('users', $users)
			->with('roles', $roles);
	}

	public function action_new()
	{
		$roles = \Verify\Models\Role::lists('name', 'id');
		return View::make('site.users.new')
			->with('roles', $roles);
	}

	public function action_edit($id)
	{
		$roles = \Verify\Models\Role::lists('name', 'id');
		$user = \Verify\Models\User::find($id);
		$permissions = \Verify\Models\Permission::all();
		return View::make('site.users.edit')
			->with('roles', $roles)
			->with('user', $user);
	}

}