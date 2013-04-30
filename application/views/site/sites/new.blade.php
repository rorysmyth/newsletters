@layout('site.master')

@section('title')
	New Site
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

	<div class="row-fluid">

		{{-- ------------------------		LHS		------------------------ --}}
		<div class="span12">
			
			{{Form::open( URL::to_route('api_site') ) }}

				<p>
					{{Form::label('title', 'Title')}}
					{{Form::text('title', Input::old('title'))}}
				</p>

				<p>
					{{Form::label('label', 'Label')}}
					{{Form::text('label', Input::old('label'))}}
				</p>

				<p>
					{{Form::submit('Add Site', array('class' => 'btn btn-standard'))}}
				</p>

			{{Form::close()}}

		</div>


	</div>

@endsection