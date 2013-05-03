<?php

class Role extends Eloquent {

	public static function add_new_role($data)
	{	
		$role = new \Verify\Models\Role;
		$role->name = array_get($data, 'name');
		$role->save();
        return $role;
	}

	public static function edit_role($id, $data)
	{	
		$role = \Verify\Models\Role::find($id);
		$role->name = array_get($data, 'name');
		$role->save();
		$role->permissions()->sync(array_get($data, 'permissions'));
        return $role;
	}

}