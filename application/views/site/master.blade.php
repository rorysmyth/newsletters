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
			<h2>@yield('title')</h2>
		</div>
	</div>

	<!-- main content -->
	@yield('main')
	<!-- main content -->

</div>

{{ Asset::container('footer')->scripts() }}

@yield('handlebars')


</body>
</html>