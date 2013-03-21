@layout('site.master')

@section('title')
	New Template
@endsection

@section('main')

	@if( $errors->has() )
	<div class="row-fluid">
		<div class="span12">
			<ul>
			    @foreach($errors->all() as $message)
				    <li>{{ $message }}</li>
			    @endforeach
			</ul>
		</div>
	</div>
	@endif	

	<div class="row-fluid">

		{{-- ------------------------		LHS		------------------------ --}}
		<div class="span12">
			
			{{Form::open( URL::to_route('api_template') ) }}

			<p>
				{{Form::label('title', 'Title')}}
				{{Form::text('title', Input::old('title'))}}
			</p>

			<p>
				{{Form::label('site_id', 'Site')}}
				{{Form::select('site_id', $sites )}}
			</p>

			<p>
				{{Form::label('code', 'Template Code')}}
				{{Form::textarea('code', Input::old('code'), array('class' => 'input-block-level'))}}
			</p>

			<p>{{Form::submit('Add Template', array('class' => 'btn btn-standard'))}}</p>

		{{Form::close()}}

		</div>


	</div>

@endsection