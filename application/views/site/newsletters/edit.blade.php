@layout('site.master')

@section('title')
	{{$newsletter->title}}
@endsection

@section('main')

<div class="row-fluid">
	<div class="btn-group">
	  <a href="{{URL::to_route('newsletters_duplicate', $newsletter->id)}}" class="btn btn-mini"><i class="icon-random"></i> clone</a>
	  <button data-action="newsletter-delete" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> delete</button>
	</div>
</div>

<div
        class="row-fluid"
        id="data_container"
        data-id="{{$newsletter->id}}"
        data-base-url="{{URL::to_route('newsletters_all')}}"
        data-template="{{URL::to_route('api_newsletter', $newsletter->id)}}"
        data-template-code="{{URL::to_route('api_get_template_code', $newsletter->id)}}"
        data-template-html="{{URL::to_route('api_get_template_html', $newsletter->id)}}"
        data-template-snippets="{{URL::to_route('api_get_all_snippets', $newsletter->id)}}"
        data-single-snippet="{{URL::to_route('api_get_single_snippet')}}/"
>


	{{-- ------------------------		LHS		------------------------ --}}
	<div id="snippets" class="span3">
		<div class="loading"></div>
		<div class="bs-docs-sidebar">
			<ul class="nav nav-list bs-docs-sidenav"></ul>
		</div>
		<a id="snippet_add_button" data-action="add-new-snippet" = href="#" class="btn btn-primary"><i class="icon-plus-sign icon-white"></i>  new</a>
	</div>



	{{-- ------------------------		RHS		------------------------ --}}
	<div class="span9">
	
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

				<div class="loading"></div>

				<div class="tab-pane active" id="template_preview">
					<iframe id="Frame" width="100%" src="{{URL::to_route('api_get_template_code', $newsletter->id)}}" frameborder="0"></iframe>
				</div>
				
				<div class="tab-pane" id="template_code">
					<pre class="prettyprint">
						<code id="code" class="lang-html"></code>
					</pre>
				</div>

				<div class="tab-pane" id="raw">
					<textarea class="input-block-level" id="raw_code" cols="30" rows="10">curde</textarea>
				</div>

			</div>
		</div>

	</div>

	<div id="modal_container"></div>
	<div id="html_preview"></div>
			
</div>

@endsection

@section('handlebars')
    @render('site/partials/handlebarTemplates/alertMessages')
    @render('site/partials/handlebarTemplates/modalPopups')
@endsection