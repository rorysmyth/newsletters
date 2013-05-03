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
					{{Form::label('role', 'role')}}
					{{Form::select('role', $roles)}}
				</p>

				<p>
					<fieldset>
						<legend>Change Password</legend>
						{{Form::label('password', 'Old Password')}}
						{{Form::password('old_password')}}

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