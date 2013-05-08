<!DOCTYPE html>
<html lang="en">
<head>
	<title>@yield('title')</title>
	{{ Asset::container('header')->styles() }}
</head>
<body @yield('body_class') >

@render('site.partials.nav')

<!-- <div class="row-fluid fluid-container"> -->
<div class="row-fluid fluid-container">
	
	<div class="row-fluid">
		<div class="span6">
			<h4>@yield('title')</h4>
		</div>
		<div class="span6 actions">
			@yield('actions')
		</div>
	</div>
	<hr>

	<!-- main content -->
	@yield('main')
	<!-- main content -->

@if(Auth::user()->username == "Pascal")
<div id="pig">Bonjour!</div>
@endif

</div>

@render('site.dev.index')

{{ Asset::container('footer')->scripts() }}

@yield('handlebars')

</body>
</html>