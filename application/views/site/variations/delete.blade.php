@layout('site.master')

@section('title')
	Delete Variation
@endsection

@section('main')

	@render('site.partials.alerts')

	<div class="row-fluid">
		
		{{Form::open( URL::to_route('api_newsletter_variation', $variation->id) ) }}

			<p>
				{{Form::text('variation', Input::old('variation'), array('placeholder' => 'variation name'))}}
			</p>

			<p>{{Form::submit('Create Variation', array('class' => 'btn btn-standard', 'data-loading-text' => 'creating variation'))}}</p>

		{{Form::close()}}

	</div>

@endsection