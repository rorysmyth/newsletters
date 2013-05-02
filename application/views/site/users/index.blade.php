@layout('site.master')

@section('title')
	Users
@endsection

@section('main')

	@render('site.partials.alerts')

	<div class="row-fluid">

		<div class="span12">
			<table class=" table table-hover table-striped">
				<thead>
					<tr>
						<th>name</th>
						<th>role</th>
						<th>verified</th>
					</tr>
				</thead>
				<tbody>
					@foreach($users as $user)
					<tr>
						<td><a href="{{URL::to_route('user', $user->id)}}">{{$user->username}}</a></td>
						<td class="date">@foreach($user->roles as $role){{$role->name}}@endforeach</td>
						<td>
							<span class="label label{{$user->verified ? '-success' : ''}}">{{$user->verified ? 'verified' : 'not verified'}}</span>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>	
		</div>

	</div>


@endsection