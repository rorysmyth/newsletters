@layout('site.master')

@section('title')
	Variation on {{$clone->title}}
@endsection

@section('main')

	@render('site.partials.alerts')

	<div class="row-fluid">
		
		{{Form::open( URL::to_route('api_newsletter_variation', $clone->id) ) }}

			<p>
				{{Form::text('variation', Input::old('variation'), array('placeholder' => 'variation name'))}}
			</p>

			<p>{{Form::submit('Create Variation', array('class' => 'btn btn-standard', 'data-loading-text' => 'creating variation'))}}</p>

		{{Form::close()}}

	</div>

@endsection