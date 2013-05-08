<div id="dev">

{{ Form::open('login') }}
	<p style="display:none">{{ Form::text('username', 'copywriter')}}</p>
	<p style="display:none">{{ Form::text('password', 'password') }}</p>
	<p style="display:none">{{ Form::text('url', URL::current() ) }}</p>
	<p>{{ Form::submit('Login as copywriter') }}</p>
{{ Form::close() }}
	
{{ Form::open('login') }}
	<p style="display:none">{{ Form::text('username', 'designer')}}</p>
	<p style="display:none">{{ Form::text('password', 'password') }}</p>
	<p style="display:none">{{ Form::text('url', URL::current() ) }}</p>
	<p>{{ Form::submit('Login as designer') }}</p>
{{ Form::close() }}

{{ Form::open('login') }}
	<p style="display:none">{{ Form::text('username', 'admin')}}</p>
	<p style="display:none">{{ Form::text('password', 'password') }}</p>
	<p style="display:none">{{ Form::text('url', URL::current() ) }}</p>
	<p>{{ Form::submit('Login as admin') }}</p>
{{ Form::close() }}

</div>