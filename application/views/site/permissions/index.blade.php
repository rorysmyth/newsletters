@layout('site.master')

@section('title')
	Permissions
@endsection

@section('actions')

	<div class="btn-group">
	  <a href="{{URL::to_route('permission_new')}}" class="btn btn-standard"><i class="icon-plus"></i> new</a>
	</div>

@endsection

@section('main')

	@render('site.partials.alerts')

	<div class="row-fluid">

		<div class="span12">
			<table class=" table table-hover table-striped">
				<thead>
					<tr>
						<th>name</th>
					</tr>
				</thead>
				<tbody>
					@foreach($permissions as $permission)
					<tr>
						<td><a href="{{URL::to_route('permission', $permission->id)}}">{{$permission->name}}</a></td>
					</tr>
					@endforeach
				</tbody>
			</table>	
		</div>

	</div>

@endsection