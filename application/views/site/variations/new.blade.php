@layout('site.master')

@section('title')
	Variation on {{$clone->title}}
@endsection

@section('main')

	@if( $errors->has() )
	<div class="row-fluid">
	    @foreach($errors->all() as $message)
		<div class="span12 alert">
		    {{ $message }}
		</div>
	   @endforeach
	</div>
	@endif

	@if( Session::has('alert')  )
	<div class="row-fluid">
		<div class="span12 alert">
		    {{ Session::get('alert') }}
		</div>
	</div>
	@endif

	@if( Session::has('test') )
	<p>Test has been set</p>
	@endif

	<div class="row-fluid">
		
		{{Form::open( URL::to_route('api_newsletter_variation', $clone->id) ) }}

			<p>
				{{Form::text('variation', Input::old('variation'), array('placeholder' => 'variation name'))}}
			</p>

			<p>{{Form::submit('Create Variation', array('class' => 'btn btn-standard', 'data-loading-text' => 'creating variation'))}}</p>

		{{Form::close()}}

	</div>

@endsection