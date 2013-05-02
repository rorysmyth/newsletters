@layout('site.master')

@section('title')
	New User
@endsection

@section('main')

	@render('site.partials.alerts')

	<div class="row-fluid">

		{{-- ------------------------		LHS		------------------------ --}}
		<div class="span12">
			
			{{Form::open( URL::to_route('api_users') ) }}

				<p>
					{{Form::label('username', 'username')}}
					{{Form::text('username', Input::old('username'))}}
				</p>

				<p>
					{{Form::label('email', 'email')}}
					{{Form::text('email', Input::old('email'))}}
				</p>

				<p>
					{{Form::label('role', 'role')}}
					{{Form::select('role', $roles  )}}
				</p>

				<p>
					{{Form::label('password', 'password')}}
					{{Form::password('password')}}
				</p>

				<p class="form-inline">
					{{Form::label('verified', 'Verified', array('class' => 'radio inline'))}}
					{{Form::radio('verified', '1', true )}}

					{{Form::label('verified', 'Not Verified', array('class' => 'radio inline'))}}
					{{Form::radio('verified', '0')}}
				</p>

				<p>
					{{Form::submit('Add Site', array('class' => 'btn btn-standard'))}}
				</p>

			{{Form::close()}}

		</div>


	</div>

@endsection