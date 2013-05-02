@if( $errors->has() )
    @foreach($errors->all() as $message)
	<div class="row-fluid">
		    <div class="span12 alert">
		    	{{ $message }}
		    </div>
	</div>
    @endforeach
@endif	

@if( Session::has('alert')  )
<div class="row-fluid">
	<div class="span12 alert">
	    {{ Session::get('alert') }}
	</div>
</div>
@endif