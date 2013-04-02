@layout('site.master')

@section('title')
	Templates
@endsection

@section('main')

	<div class="row-fluid">

		{{-- ------------------------		LHS		------------------------ --}}
		<div class="span4">
			<table class=" table table-hover">
				<thead>
					<tr>
						<th></th>
						<th>title</th>
						<th>date</th>
						<th>action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($templates->results as $template)
					<tr>
						<td>
							<button data-action="template-delete" class="btn btn-mini btn-danger">
							<i class="icon-remove icon-white"></i>
							</button>
						</td>
						<td> <a href="#" data-action="template-preview">{{$template->title}}</a></td>
						<td class="date">{{Helpers::niceDate($template->created_at)}}</td>
						<td>
							<div class="btn-group">
						  		<button data-action="template-preview" class="btn btn-mini"><i class="icon-eye-open"></i></button>
								<a href="{{URL::to_route('templates', $template->id)}}" class="btn btn-mini"><i class="icon-pencil"></i></a>
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>	

			<div>
				{{$templates->links()}}
			</div>

		</div>

		{{-- ------------------------		RHS		------------------------ --}}
		<div class="span8" id="preview_pane">
			<iframe src="" width="100%" frameborder="0"></iframe>
		</div>


	</div>

@endsection