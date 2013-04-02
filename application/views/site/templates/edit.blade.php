@layout('site.master')

@section('title')
{{$template->title}}
@endsection

@section('main')

<div
        class="row-fluid"
        id="data_container"
>


	{{-- ------------------------		LHS		------------------------ --}}
	<div class="span8">
	
		<div class="row-fluid">
			
			<div id="editor_buttons" class="btn-group pull-right">
			  <button data-action="template-edit" class="btn"><i class="icon-edit"></i> edit</button>
			  <button data-action="code-refresh" class="btn"><i class="icon-refresh"></i> refresh</button>
			</div>

			<ul class="nav nav-tabs">
				  <li class="active"><a href="#template_preview" data-toggle="tab"><i class="icon-eye-open"></i> Preview</a></li>
				  <li><a href="#template_code" data-toggle="tab"><i class="icon-th-large"></i> Code</a></li>
				  <li><a href="#raw" data-toggle="tab"><i class="icon-th-large"></i> Raw</a></li>
			</ul>

			<div class="tab-content">

				<div class="tab-pane active" id="template_preview">
					<iframe id="Frame" width="100%" src="" frameborder="0"></iframe>
				</div>
				
				<div class="tab-pane" id="template_code">
					<pre class="prettyprint">
						<code id="code" class="lang-html"></code>
					</pre>
				</div>

				<div class="tab-pane" id="raw">
					
					{{Form::open( URL::to_route('api_template', $template->id), 'PUT' )}}
						{{Form::textarea('code', $template->code , array('class' => 'input-block-level', 'id' => 'raw_code')) }}
						{{Form::submit('update template')}}
					{{Form::close()}}

				</div>

			</div>
		</div>

	</div>


	{{-- ------------------------		LHS		------------------------ --}}
	<div class="span4">

		<div class="well">
			<ul>
				<li>Test</li>
			</ul>
		</div> 	

	</div>
			
</div>

@endsection

@section('handlebars')

@endsection