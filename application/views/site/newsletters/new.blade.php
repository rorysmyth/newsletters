@layout('site.master')

@section('title')
	Add New
@endsection

@section('main')

	<div class="row-fluid">
		
		{{Form::open( URL::to_route('api_newsletter') ) }}

			<p>
				{{Form::label('title', 'Title')}}
				{{Form::text('title', 'Title')}}
			</p>

			<p>
				{{Form::label('site_id', 'Site')}}
				{{Form::select('site_id', $sites )}}
			</p>

			<p>
				{{Form::label('template_id', 'Template')}}
				{{Form::select('template_id', $templates )}}
			</p>

			<p>
				{{Form::label('template', 'Template Code')}}
				{{Form::textarea('template', '', array('class' => 'input-block-level'))}}
			</p>

			<p>{{Form::submit('Add Newsletter', array('class' => 'btn btn-standard'))}}</p>

		{{Form::close()}}

	</div>

@endsection