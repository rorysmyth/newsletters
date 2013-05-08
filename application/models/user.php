<?php

class User extends Eloquent {

	public static function update_user($id, $data)
	{	
		$user = \Verify\Models\User::find($id);
		
		// if(Hash::check($user->salt . array_get($data, 'old_password'), $user->password))
		// {
		// 	$user->password = array_get($data, 'new_password');
		// }

		if(array_get($data, 'new_password') != "")
		{
			$user->password = array_get($data, 'new_password');
		}
		
		$user->username = array_get($data, 'username');
		$user->email    = array_get($data, 'email');
		$user->verified = array_get($data, 'verified');
		
		$user->roles()->sync(array_get($data, 'roles'));
		$user->save();

	}

}