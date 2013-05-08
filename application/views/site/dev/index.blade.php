<div>

{{ Form::open('login') }}
	<p style="display:none">{{ Form::text('username', 'Heather')}}</p>
	<p style="display:none">{{ Form::text('password', 'password') }}</p>
	<p style="display:none">{{ Form::text('url', URL::current() ) }}</p>
	<p>{{ Form::submit('Login as Heather') }}</p>
{{ Form::close() }}
	
{{ Form::open('login') }}
	<p style="display:none">{{ Form::text('username', 'Pascal')}}</p>
	<p style="display:none">{{ Form::text('password', 'password') }}</p>
	<p style="display:none">{{ Form::text('url', URL::current() ) }}</p>
	<p>{{ Form::submit('Login as Pascal') }}</p>
{{ Form::close() }}

{{ Form::open('login') }}
	<p style="display:none">{{ Form::text('username', 'Rory')}}</p>
	<p style="display:none">{{ Form::text('password', 'password') }}</p>
	<p style="display:none">{{ Form::text('url', URL::current() ) }}</p>
	<p>{{ Form::submit('Login as Rory') }}</p>
{{ Form::close() }}

{{ Form::open('login') }}
	<p style="display:none">{{ Form::text('username', 'Rory')}}</p>
	<p style="display:none">{{ Form::text('password', 'password') }}</p>
	<p style="display:none">{{ Form::text('url', URL::current() ) }}</p>
	<p>{{ Form::submit('Login Admin') }}</p>
{{ Form::close() }}

</div>