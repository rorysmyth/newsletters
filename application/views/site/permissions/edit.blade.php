@layout('site.master')

@section('title')
	Edit Permission
@endsection

@section('main')

	@render('site.partials.alerts')

	<div class="row-fluid">

		{{-- ------------------------		LHS		------------------------ --}}
		<div class="span12">
			
			{{Form::open( URL::to_route('api_permissions', $permission->id), 'PUT' ) }}

				<p>
					{{Form::label('name', 'name')}}
					{{Form::text('name', $permission->name)}}
				</p>

				<p>
					{{Form::submit('Edit Permission', array('class' => 'btn btn-standard'))}}
				</p>

			{{Form::close()}}

		</div>

	</div>

@endsection