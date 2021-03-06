<!DOCTYPE html>
<html lang="en">
<head>
	<title>@yield('title')</title>
	{{ Asset::container('header')->styles() }}
</head>
<body>

@render('site.partials.nav')

<div class="row-fluid fluid-container">
	
	<div class="row-fluid">
		<div class="span12">
			<h4>@yield('title')</h4>
		</div>
		@yield('actions')
	</div>
	<hr>

	<!-- main content -->
	@yield('main')
	<!-- main content -->

</div>

{{ Asset::container('footer')->scripts() }}

@yield('handlebars')


</body>
</html>