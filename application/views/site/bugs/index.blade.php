@layout('site.master')

@section('title')
	Bugs
@endsection

@section('main')

	@render('site.partials.alerts')

	<div class="row-fluid">

		{{-- ------------------------		P1		------------------------ --}}
		<div class="span4">
			<span class="label label-important">High Priority</span>
			<table class=" table table-hover table-striped">
				<thead>
					<tr>
						<th>title</th>
						<th>created</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($bugs_p1 as $bug)
					<tr>
						<td> <a href="{{URL::to_route('bug', $bug->id)}}">{{$bug->title}}</a></td>
						<td class="date">{{Helpers::niceDate($bug->created_at)}}</td>
						<td>
							<div class="btn-group">
								<button class="btn btn-mini dropdown-toggle" data-toggle="dropdown">action <span class="caret"></span></button>
								<ul class="dropdown-menu">
									<li><a href="#">Resolve</a></li>
								</ul>
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>	
		</div>
		{{-- ------------------------		/P1		------------------------ --}}

		{{-- ------------------------		P1		------------------------ --}}
		<div class="span4">
			<span class="label label-warning">Medium Priority</span>
			<table class=" table table-hover table-striped">
				<thead>
					<tr>
						<th>title</th>
						<th>created</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($bugs_p2 as $bug)
					<tr>
						<td> <a href="{{URL::to_route('bug', $bug->id)}}">{{$bug->title}}</a></td>
						<td class="date">{{Helpers::niceDate($bug->created_at)}}</td>
						<td>
							<div class="btn-group">
								<button class="btn btn-mini dropdown-toggle" data-toggle="dropdown">action <span class="caret"></span></button>
								<ul class="dropdown-menu">
									<li><a href="#">Resolve</a></li>
								</ul>
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>	
		</div>
		{{-- ------------------------		/P1		------------------------ --}}

		{{-- ------------------------		P1		------------------------ --}}
		<div class="span4">
			<span class="label label-success">Low Priority</span>
			<table class=" table table-hover table-striped">
				<thead>
					<tr>
						<th>title</th>
						<th>created</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($bugs_p3 as $bug)
					<tr>
						<td> <a href="{{URL::to_route('bug', $bug->id)}}">{{$bug->title}}</a></td>
						<td class="date">{{Helpers::niceDate($bug->created_at)}}</td>
						<td>
							<div class="btn-group">
								<button class="btn btn-mini dropdown-toggle" data-toggle="dropdown">action <span class="caret"></span></button>
								<ul class="dropdown-menu">
									<li><a href="#">Resolve</a></li>
								</ul>
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>	
		</div>
		{{-- ------------------------		/P1		------------------------ --}}


	</div>

	<div class="row-fluid well">
		<h4>Bugs Fixed</h4>
		<table class="table table-condensed">
			<thead>
				<th>title</th>
				<th>description</th>
				<th></th>
			</thead>
			<tbody style="text-decoration:line-through">
				@foreach($resolved as $bug)
				<tr>
					<td>{{$bug->title}}</td>
					<td>{{$bug->description}}</td>
					<td>
						<div class="btn-group">
							<button class="btn btn-mini dropdown-toggle" data-toggle="dropdown">action <span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="#">Reopen</a></li>
							</ul>
						</div>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

@endsection