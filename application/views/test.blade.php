@layout('site.master')

@section('title')
	Testing Cloudfiles
@endsection

@section('main')

	<div class="row-fluid">
		
		{{Form::open( '/' ) }}

			<p>
				{{Form::label('title', 'New Title')}}
				{{Form::text('title', 'value')}}
			</p>

			<p>{{Form::submit('create container', array('class' => 'btn btn-standard'))}}</p>

		{{Form::close()}}

	</div>

@endsection

