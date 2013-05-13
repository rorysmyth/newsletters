@layout('site.master')

@section('title')
	New Block
@endsection

@section('main')

	@render('site.partials.alerts')

	<div class="row-fluid">

		{{-- ------------------------		LHS		------------------------ --}}
		<div class="span12">
			
			{{Form::open( URL::to_route('api_blocks') ) }}

			<p>
				{{Form::label('title', 'Title')}}
				{{Form::text('title', Input::old('title'))}}
			</p>

			<p>
				{{Form::label('site_id', 'Site')}}
				{{Form::select('site_id', $sites )}}
			</p>

			<p>
				{{Form::label('code', 'Code')}}
				{{Form::textarea('code', Input::old('code'), array('class' => 'input-block-level'))}}
			</p>

			<p>{{Form::submit('Add Block', array('class' => 'btn btn-standard'))}}</p>

		{{Form::close()}}

		</div>


	</div>

@endsection