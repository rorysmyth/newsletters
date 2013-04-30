@layout('site.master')

@section('title')
	Delete Variation
@endsection

@section('main')

	@if( $errors->has() )
	    @foreach($errors->all() as $message)
		<div class="row-fluid">
			<div class="span12 alert">
		    	{{ $message }}
			</div>
		</div>
	   @endforeach
	@endif

	@if( Session::has('alert')  )
	<div class="row-fluid">
		<div class="span12 alert">
		    {{ Session::get('alert') }}
		</div>
	</div>
	@endif

	<div class="row-fluid">
		
		{{Form::open( URL::to_route('api_newsletter_variation', $variation->id) ) }}

			<p>
				{{Form::text('variation', Input::old('variation'), array('placeholder' => 'variation name'))}}
			</p>

			<p>{{Form::submit('Create Variation', array('class' => 'btn btn-standard', 'data-loading-text' => 'creating variation'))}}</p>

		{{Form::close()}}

	</div>

@endsection