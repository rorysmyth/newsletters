@layout('site.master')

@section('title')
	Edit User
@endsection

@section('actions')
	<div class="btn-group">
		{{Form::open( URL::to_route('api_users', $user->id), 'DELETE' ) }}
	  		<button class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> delete</button>
	  	{{Form::close()}}
	</div>
@endsection

@section('main')

	@render('site.partials.alerts')

	<div class="row-fluid">

		{{-- ------------------------		LHS		------------------------ --}}
		<div class="span12">
			
			{{Form::open( URL::to_route('api_users', $user->id), 'PUT' ) }}

				<p>
					{{Form::label('username', 'username')}}
					{{Form::text('username', $user->username)}}
				</p>

				<p>
					{{Form::label('email', 'email')}}
					{{Form::text('email', $user->email)}}
				</p>

				<p>
					<fieldset>
						<legend>Roles</legend>
						{{Form::label('role', 'role')}}
						@foreach($roles as $role)
							<p class="form-inline">
							{{Form::checkbox('roles[]', $role->id, in_array($role->id, $user_roles) ? 'true' : '' )}}
							{{Form::label($role->name, $role->name)}}
							</p>
						@endforeach
					</fieldset>
				</p>

				<p>
					<fieldset>
						<legend>Password</legend>
						{{Form::label('password', 'New Password')}}
						{{Form::password('new_password')}}
					</fieldset>
				</p>

				<p class="form-inline">
					{{Form::label('verified', 'Verified?', array('class' => 'radio inline'))}}
					{{Form::radio('verified', '1', $user->verified ? 'true' : ''  )}}
					{{Form::label('verified', 'Not Verified', array('class' => 'radio inline'))}}
					{{Form::radio('verified', '0', $user->verified ? '' : 'false')}}
				</p>

				<p>
					{{Form::submit('Edit User', array('class' => 'btn btn-standard'))}}
				</p>

			{{Form::close()}}

		</div>


	</div>

@endsection