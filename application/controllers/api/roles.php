<?php 


class Api_Roles_Controller extends Base_Controller {

	public $restful = true;

	public function post_index()
	{
		$data = array(
			'name' => Input::get('name')
		);
		
		$rules = array(
			'name' => 'required|alpha_dash'
		);

		$validation = Validator::make($data, $rules);

		if($validation->fails())
		{
			return Redirect::to_route('role_new')
				->with_errors($validation->errors)
				->with_input();
		} else {
			$role = Role::add_new_role($data);
			return Redirect::to_route('role', $role->id)
				->with('alert', $role->name . ' added');
		}
	}

	public function put_index($id)
	{

		$role = \Verify\Models\Role::find($id);
		
		$data = array(
			'name'        => Input::get('name'),
			'permissions' => Input::get('permissions')
		);
		
		$rules = array(
			'name' => 'required|alpha_dash'
		);

		$validation = Validator::make($data, $rules);

		if($validation->fails())
		{
			return Redirect::to_route('role', $role->id)
				->with_errors($validation->errors)
				->with_input();

		} else {

			$role = Role::edit_role($role->id, $data);
			return Redirect::to_route('role', $role->id)
				->with('alert', $role->name . ' edited');
				
		}

	}

}