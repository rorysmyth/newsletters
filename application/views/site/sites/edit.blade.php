@layout('site.master')

@section('title')
	{{$site->title}}
@endsection

@section('actions')
	<div class="btn-group">
	  <button href="{{URL::to_route('api_site', $site->id)}}" data-action="site-delete" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> delete</button>
	</div>
@endsection

@section('main')

@render('site.partials.alerts')

<div class="row-fluid" >

	{{-- ------------------------		LHS		------------------------ --}}
	<div class="span8">
				
		{{Form::open( URL::to_route('api_site', $site->id), 'PUT' )}}
			
			<p>
				{{Form::label('title','Title')}}
				{{Form::text('title', $site->title) }}
			</p>
			
			<p>
				{{Form::label('label','Colour Label: #000000 format')}}
				{{Form::text('label', $site->label) }}
			</p>				
				
			<p>
				{{Form::submit('update', array('class' => 'btn') )}}
			</p>

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