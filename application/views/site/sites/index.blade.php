@layout('site.master')

@section('title')
	Sites
@endsection

@section('main')

	@render('site.partials.alerts')

	<div class="row-fluid">

		{{-- ------------------------		LHS		------------------------ --}}
		<div class="span12">
			<table class=" table table-hover">
				<thead>
					<tr>
						<th>title</th>
						<th>date</th>
						<th>action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($sites->results as $site)
					<tr>
						<td> <a href="{{URL::to_route('sites', $site->id)}}">{{$site->title}}</a></td>
						<td class="date">{{Helpers::niceDate($site->created_at)}}</td>
						<td>
							<div class="btn-group">
								<a href="{{URL::to_route('sites', $site->id)}}" class="btn btn-mini"><i class="icon-pencil"></i></a>
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>	

			<div>
				{{$sites->links()}}
			</div>

		</div>


	</div>

@endsection