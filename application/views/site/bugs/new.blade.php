@layout('site.master')

@section('title')
	New Bug
@endsection

@section('main')

	@render('site.partials.alerts')

	<div class="row-fluid">

		{{-- ------------------------		LHS		------------------------ --}}
		<div class="span12">
			
			{{Form::open( URL::to_route('api_bugs') ) }}

				<p>
					{{Form::label('title', 'Title')}}
					{{Form::text('title', Input::old('title'))}}
				</p>

				<p>
					{{Form::label('priority', 'Priority')}}
					<span class="label label-important">{{Form::radio('priority', '1', '1' )}} high</span>
					<span class="label label-warning">{{Form::radio('priority', '2', '2' )}} medium</span>
					<span class="label label-success">{{Form::radio('priority', '3', '3' )}} low</span>
					<span class="label">{{Form::radio('priority', '4', '4' )}} not important</span>
				</p>

				<p>
					{{Form::label('description', 'Description') }}
					{{Form::textarea('description', Input::old('description'),  array('class' => 'input-block-level') )}}
				</p>

				<p>
					{{Form::submit('Submit Bug', array('class' => 'btn btn-standard'))}}
				</p>

			{{Form::close()}}

		</div>


	</div>

@endsection