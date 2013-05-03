@layout('site.master')

@section('title')
	Roles
@endsection

@section('actions')
	<div class="btn-group">
	  <a href="{{URL::to_route('role_new')}}" class="btn btn-standard"><i class="icon-plus"></i> new</a>
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
					@foreach($roles as $role)
					<tr>
						<td><a href="{{URL::to_route('role', $role->id)}}">{{$role->name}}</a></td>
					</tr>
					@endforeach
				</tbody>
			</table>	
		</div>

	</div>

@endsection