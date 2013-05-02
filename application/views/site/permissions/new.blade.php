@layout('site.master')

@section('title')
	New Permission
@endsection

@section('main')

	@render('site.partials.alerts')

	<div class="row-fluid">

		{{-- ------------------------		LHS		------------------------ --}}
		<div class="span12">
			
			{{Form::open( URL::to_route('api_permissions') ) }}

				<p>
					{{Form::label('name', 'name')}}
					{{Form::text('name', Input::old('name'))}}
				</p>

				<p>
					{{Form::submit('Add Permission', array('class' => 'btn btn-standard'))}}
				</p>

			{{Form::close()}}

		</div>


	</div>

@endsection