@layout('site.master')

@section('title')

	{{$newsletter->title}}

@endsection

@section('actions')

	<div class="btn-group">
	  <a href="{{URL::to_route('api_download_newsletter_templates', $newsletter->id)}}" class="btn btn-mini"><i class="icon-download-alt"></i> download</a>
	  <a href="{{URL::to_route('newsletters_duplicate', $newsletter->id)}}" class="btn btn-mini"><i class="icon-random"></i> clone</a>
	  <a href="{{URL::to_route('newsletters_variation', $newsletter->id)}}" class="btn btn-mini"><i class="icon-plus"></i> variation</a>
	  <button data-action="newsletter-delete" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> delete</button>
	</div>

@endsection

@section('main')

<div
        id="data_container"
        data-site-base = "{{URL::base()}}"
        data-id="{{$newsletter->id}}"
        data-base-url="{{URL::to_route('newsletters_all')}}"
        data-template="{{URL::to_route('api_newsletter', $newsletter->id)}}"
        data-template-code="{{URL::to_route('api_get_template_code', array($newsletter->id, $variation) )}}"
        data-template-html="{{URL::to_route('api_get_template_html', array($newsletter->id, $variation))}}"
        data-template-snippets="{{URL::to_route('api_get_all_newsletter_snippets', array($newsletter->id, $variation))}}"
        data-single-snippet="{{URL::to_route('api_get_single_snippet')}}/"
        data-variation="{{$variation}}"
        data-variations-all="{{URL::to_route('api_newsletter_variation', $newsletter->id)}}"
        data-default="{{URL::to_route('newsletters', $newsletter->id)}}"

>


	{{-- ------------------------		Variations		------------------------ --}}
	<div id="variations" class="span1">

			@if(isset($variation_list))
				@foreach($variation_list as $variant)
				<div class="btn-group">
					<a class="btn dropdown-toggle {{ URI::segment(3) == $variant ? 'btn-primary' : '' }}" data-toggle="dropdown" href="#">
					{{$variant}}
					<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="{{URL::to_route('newsletters', array( $newsletter->id, $variant ) )}}">view</a></li>
						<li class="divider"></li>
						<li><a data-action="delete-variation" href="{{URL::to_route('api_variation_delete', array($newsletter->id, $variant))}}">delete</a></li>
					</ul>
				</div>
				@endforeach
			@endif


	</div>

	{{-- ------------------------		LHS		------------------------ --}}
	<div id="snippets" class="span3">

		<div class="well">
			<a id="snippet_add_button" data-action="add-new-snippet" class="btn btn-primary btn-block"><i class="icon-plus-sign icon-white"></i>  new</a>
			<ul class="nav nav-list"></ul>
		</div> 	

	</div>



	{{-- ------------------------		RHS		------------------------ --}}
	<div class="span8">
	
		<div class="row-fluid">
			
			{{Form::open(URL::to_route('newsletters'), 'PUT', array('id'=>'quick_template', 'class' => 'form-inline') )}}
				{{Form::hidden('id', $newsletter->id )}}
				{{Form::select('template_id', $templates, $newsletter->template_id )}}
				{{Form::label('template_override', 'Template Override')}}
					{{Form::checkbox('template_override', '1', $newsletter->template_override );}}
				
				<span id="quick_template_alert" class="alert alert-success">updated</span>
			{{Form::close()}}

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
					<iframe id="Frame" width="100%" src="{{URL::to_route('api_get_template_code', array($newsletter->id, $variation))}}" frameborder="0"></iframe>
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
    @render('site/partials/handlebars/alerts')
    @render('site/partials/handlebars/modals')
@endsection