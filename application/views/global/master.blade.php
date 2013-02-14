<!DOCTYPE html>
<html lang="en">
<head>
	<title>@yield('title')</title>
	{{ Asset::scripts() }}
	{{ Asset::styles() }}
</head>
<body>

@render('global.nav')

<div class="container">
	
	<h2>@yield('title')</h2>

	@if(Session::has('message'))
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			{{Session::get('message')}}
		</div>
	@endif

	<!-- main content -->
	@yield('main')
	<!-- main content -->

</div>
</body>
</html>