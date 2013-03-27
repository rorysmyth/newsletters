@layout('site.master')

@section('title')
	Duplicate {{$clone->title}}
@endsection

@section('main')

	<div class="row-fluid">
		
		{{Form::open( URL::to_route('api_newsletter_duplicate', $clone->id) ) }}

			<p>
				{{Form::label('title', 'New Title')}}
				{{Form::text('title', 'CLONE ' . $clone->title)}}
			</p>

			<p>{{Form::button('Duplicate and save', array('class' => 'btn btn-standard', 'data-loading-text' => 'duplicating'))}}</p>

		{{Form::close()}}

	</div>

@endsection