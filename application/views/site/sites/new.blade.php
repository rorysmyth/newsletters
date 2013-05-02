@layout('site.master')

@section('title')
	New Site
@endsection

@section('main')

	@render('site.partials.alerts')

	<div class="row-fluid">
		<select name="value" >
			@foreach($cities as $container => $city)
				<optgroup label="{{$container}}">
				@foreach($city as $file)
					<option value="{{$file}}">{{$file}}</option>
				@endforeach
			@endforeach
		</select>
	</div>

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