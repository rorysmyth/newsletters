@layout('site.master')

@section('title')
	Recent Newsletters
@endsection

@section('main')

	<div class="row-fluid">

		{{-- ------------------------		LHS		------------------------ --}}
		<div class="span5">
			<table class=" table table-hover">
				<thead>
					<tr>
						<th>title</th>
						<th>label</th>
						<th>date</th>
						<th>action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($newsletters->results as $newsletter)
					<tr
						data-id="{{$newsletter->id}}"
						data-preview-url="{{URL::to_route('api_get_template_code', $newsletter->id)}}"
						data-newsletter-url="{{URL::to_route('api_newsletter', $newsletter->id)}}"
					>
						<td><a href="#" data-action="preview">{{$newsletter->title}}</a></td>
						<td><span style="background-color:{{$newsletter->label}}" class="label">{{$newsletter->site_title}}</span></td>
						<td class="date">{{Helpers::niceDate($newsletter->created_at)}}</td>
						<td>
								<div class="btn-group">
							  		<button data-action="preview" class="btn btn-mini"><i class="icon-eye-open"></i></button>
									<a href="{{URL::to_route('newsletters', $newsletter->id)}}" class="btn btn-mini"><i class="icon-pencil"></i></a>
								</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>	

			<div>
				{{$newsletters->links()}}
			</div>

		</div>

		{{-- ------------------------		RHS		------------------------ --}}
		<div class="span7" id="preview_pane">
			<iframe src="" width="100%" frameborder="0"></iframe>
		</div>


	</div>

@endsection