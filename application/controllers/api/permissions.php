<?php

class Api_Permissions_Controller extends Base_Controller {
	
	public $restful = true;

    public function post_index()
    {
        $permission = new \Verify\Models\Permission;
        
        $rules = array(
            'name' => 'required|alpha_dash'
        );

        $data = array(
            'name' => Input::get('name')
        );

        $validation = Validator::make($data, $rules);

        if($validation->fails())
        {
            return Redirect::to_route('permission_new')
                ->with_errors($validation->errors);

        } else {

            $permission->name = Input::get('name');
            $permission->save();
            return Redirect::to_route('permissions')
                ->with_errors('alert','new permission added!');

        }

    }

    public function put_index($id)
    {
        $permission = \Verify\Models\Permission::find($id);

        $data = array(
            'name' => Input::get('name')
        );

        $rules = array(
            'name' => 'required|alpha_dash'
        );

        $validation = Validator::make($data, $rules);

        if($validation->fails())
        {

            return Redirect::to_route('permission', $permission->id)
                ->with_errors($validation->errors);

        } else {

            $permission->name = $data['name'];
            $permission->save();
            return Redirect::to_route('permissions')
                ->with('alert','updated ' . $permission->name);

        }
    }

}