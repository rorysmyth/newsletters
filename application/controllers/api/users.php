<?php

class Api_Users_Controller extends Base_Controller {

	public $restful = true;

	public function put_index($id)
	{
		$user = \Verify\Models\User::find($id);

		$data = array(
			'username'     => Input::get('username'),
			'email'        => Input::get('email'),
			'roles'        => Input::get('roles'),
			'new_password' => Input::get('new_password'),
			'verified'     => Input::get('verified')
		);

		$rules = array(
			'username' => 'required|min:4|max:8',
			'email'    => 'required|email',
			'verified' => 'required'
		);


		$validation = Validator::make($data, $rules);

		if($validation->fails())
		{
			return Redirect::to_route('user', $user->id)
                ->with_input()
                ->with_errors($validation->errors);
		} else {
			User::update_user($user->id, $data);
			return Redirect::to_route('users')
				->with('alert', $user->username . ' updated!');
		}
	}

	public function post_index()
	{
		$data = array(
			'username' => Input::get('username'),
			'email'    => Input::get('email'),
			'role'     => Input::get('role'),
			'password' => Input::get('password'),
			'verified' => Input::get('verified')
		);
		$rules = array(
			'username' => 'required|min:4|max:8',
			'email'    => 'required|email',
			'role'     => 'required',
			'password' => 'required',
			'verified' => 'required'
		);
		$validation = Validator::make($data, $rules);

		if($validation->fails())
		{
			return Redirect::to_route('user_new')
                ->with_input()
                ->with_errors($validation->errors);

		} else {
			$user = new \Verify\Models\User;

			$user->username = $data['username'];
			$user->email    = $data['email'];
			$user->password = $data['password'];
			$user->verified = $data['verified'];
			
			$user->save();

			$user->roles()->sync($data['role']);

			return Redirect::to_route('users')
				->with('alert', $user->username . ' was added!');
		}

	}

	public function delete_index($id)
	{
		$user = \Verify\Models\User::find($id);
		$user->roles()->delete();
		$user->delete();
		return Redirect::to_route('users')
			->with('alert', 'User deleted!');
	}

}