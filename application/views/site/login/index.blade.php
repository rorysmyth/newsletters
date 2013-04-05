<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	{{ Asset::container('header')->styles() }}
</head>
<body>

<div class="row-fluid fluid-container">
	
	<!-- main content -->
	<div class="row-fluid">
		<div class="span4 offset4 well">


			<legend>Please Sign In</legend>
			@if (Session::has('login_errors'))
				<div class="alert alert-error">
					<a class="close" data-dismiss="alert" href="#">×</a> {{Session::get('login_errors')}}
				</div>
			@endif

			{{ Form::open('login') }}

				<p>{{ Form::label('username', 'Username') }}</p>
				<p>{{ Form::text('username', Input::old('username'), array('class' => 'span12', 'placeholder' => 'Username')) }}</p>

				<p>{{ Form::label('password', 'Password') }}</p>
				<p>{{ Form::password('password', array('class' => 'span12', 'placeholder' => 'Password')) }}</p>

				<p>{{ Form::submit('Login', array('class' => 'btn btn-info btn-block')) }}</p>

			{{ Form::close() }}

			</div>
			</div> 


		</div>
	</div>
	<!-- main content -->

</div>

{{ Asset::container('admin_footer')->scripts() }}

</body>
</html>