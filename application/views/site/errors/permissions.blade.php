<!DOCTYPE html>
<html lang="en">
<head>
	<title>You ain't got permissions!</title>
	{{ Asset::container('header')->styles() }}
</head>
<body class="permissions" >

@render('site.partials.nav')

<!-- <div class="row-fluid fluid-container"> -->
<div class="row-fluid fluid-container">
	
	<div class="row-fluid">
		<div class="span12">
			<h4>I'm sorry {{ Auth::user()->username }}, but I can't let you do that...</h4>
		</div>
	</div>

</div>

@render('site.dev.index')

{{ Asset::container('footer')->scripts() }}

</body>
</html>