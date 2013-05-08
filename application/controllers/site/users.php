<?php

class Site_Users_Controller extends Site_Controller
{
	public function action_index()
	{
		if(!Auth::can('view_users'))
        {
            return View::make('site.errors.permissions')
                ->with('alert', "you aren't allowed to view users");
        }
		$users = \Verify\Models\User::with(array('roles'))->get();
		$roles = \Verify\Models\Role::all();

		return View::make('site.users.index')
			->with('users', $users)
			->with('roles', $roles);
	}

	public function action_new()
	{
		if(!Auth::can('create_users'))
        {
            return View::make('site.errors.permissions')
                ->with('alert', "you aren't allowed to create users");
        }
		$roles = \Verify\Models\Role::lists('name', 'id');
		return View::make('site.users.new')
			->with('roles', $roles);
	}

	public function action_edit($id)
	{
		if(!Auth::can('edit_users'))
        {
            return View::make('site.errors.permissions')
                ->with('alert', "you aren't allowed to edit users");
        }
		$user = \Verify\Models\User::find($id);

		$roles       = \Verify\Models\Role::all();
		$permissions = \Verify\Models\Permission::all();


		$user_roles = array();
		foreach($user->roles()->pivot()->get() as $role)
		{
			array_push($user_roles, $role->role_id);
		}

		return View::make('site.users.edit')
			->with('roles', $roles)
			->with('user_roles', $user_roles)
			->with('user', $user);
	}

}