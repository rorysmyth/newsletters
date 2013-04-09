@layout('site.master')

@section('title')
	{{$site->title}}
@endsection

@section('main')

<div
        class="row-fluid"
        id="data_container"
>


	{{-- ------------------------		LHS		------------------------ --}}
	<div class="span8">
				
		{{Form::open( URL::to_route('api_site', $site->id), 'PUT', array('class'=>'form-inline') )}}
			{{Form::text('title', $site->title) }}
			{{Form::submit('update', array('class' => 'btn') )}}
		{{Form::close()}}

	</div>


	{{-- ------------------------		LHS		------------------------ --}}
	<div class="span4">

		<div class="well">
			<h4>Related Newsletters</h4>
			<ul>
				@foreach ($newsletters as $newsletter)
					<li>
						<small>{{Helpers::monthYear($newsletter->created_at)}}</small>
						{{HTML::link_to_route('newsletters', $newsletter->title, $newsletter->id ) }}
					</li>
				@endforeach
			</ul>
		</div>

	</div>
			
</div>

@endsection

@section('handlebars')

@endsection