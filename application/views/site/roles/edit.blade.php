@layout('site.master')

@section('title')
	Edit Role
@endsection

@section('main')

	@render('site.partials.alerts')

	<div class="row-fluid">

		{{-- ------------------------		LHS		------------------------ --}}
		<div class="span12">
			
			{{Form::open( URL::to_route('api_roles', $role->id), 'PUT' ) }}

				<p>
					{{Form::label('name', 'name')}}
					{{Form::text('name', $role->name)}}
				</p>

				<fieldset>
					<legend>Permissions</legend>
					@foreach($permissions as $permission)
						<p class="form-inline">
							{{Form::checkbox('permissions[]', $permission->id, in_array($permission->id, $granted) ? 'true' : '' )}}
							{{Form::label($permission->name, $permission->name)}}
						</p>
					@endforeach
				</fieldset>

				<p>
					{{Form::submit('Update Role', array('class' => 'btn btn-standard'))}}
				</p>

			{{Form::close()}}

		</div>


	</div>

@endsection