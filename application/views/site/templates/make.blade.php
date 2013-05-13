@layout('site.master')

@section('title')
	Make Template
@endsection

@section('main')

<style>
	#sources li.ui-draggable-dragging {
		width: 200px;
	}
	ul#build {
		min-height: 40px;
		border: 1px dashed #ccc;
		padding:15px;
	}
</style>

	@render('site.partials.alerts')
	
	<div class="row-fluid">

		{{-- ------------------------		Sources		------------------------ --}}
		<div class="span2">
			<h4>sources</h4>
			<ul class="nav nav-tabs nav-stacked" id="sources">
				@foreach($blocks as $block)
				<li data-block-id="{{$block->id}}"><a href="#">{{$block->slug}}</a></li>
				@endforeach
			</ul>
		</div>

		{{-- ------------------------		Build		------------------------ --}}
		<div class="span2">

			<div id="trash" class="well">
				<i class="icon-trash"></i>  trash
			</div>

			<h4>build</h4>
			<ul id="build" class="nav nav-tabs nav-stacked"></ul>
		</div>


		{{-- ------------------------		Preview		------------------------ --}}
		<div class="span8">
			
			<div class="btn-group">
				<a data-action="generate-template" class="btn">generate</a>
			</div>

			<iframe id="previewFrame" width="100%" src="/wrapper" frameborder="0"></iframe>

			{{Form::open(URL::to_route('newsletters_new'))}}
				{{Form::textarea('code', "", array('class' => 'input-block-level', 'id' => 'output'))}}
				{{Form::button('create')}}
			{{Form::close()}}
		</div>
		

	</div>

@endsection

@section('handlebars')
<script>

$(function(){

	/*=================================================

    listeners

    =================================================*/
	$('body').on('click', 'a[data-action="generate-template"]', function(e){
		
		// generate the query
        var query = templateBuildQuery.create();
        templateBuildQuery.makeRequest(query);
        
        e.preventDefault();

    });

    $('body').on('click', 'a[data-action="make-from-template"]', function(e){
		
		// get the code being used

        
        e.preventDefault();

    });

	/*=================================================

    sources

    =================================================*/
	
	var sources = sources || {};
	
	sources.config = {
		el : $('#sources li'),
		ul: "#sources"
	}

	/*=================================================

    build

    =================================================*/
	
	var build = build || {};
	
	build.config = {
		el : $('#build li'),
		ul: "#build"
	}


	/*=================================================

    trash

    =================================================*/
	
	var trash = trash || {};
	
	trash.config = {
		el : $('#trash'),
	}


	/*=================================================

    generate

    =================================================*/
	
	var generate = generate || {};
	
	generate.config = {
		el: $('#output'),
		div: '#output'
	}

	/*=================================================

    preview

    =================================================*/
	
 	var preview = preview || {};

    preview.config = {
        el: $('#previewFrame')
    };

    preview.setHeight = function(){
        var height = preview.config.el.contents().height();
        preview.config.el.attr('height', height);
    };

    preview.init = function(){
        preview.config.el.on('load', function(){
            preview.setHeight();
        });
    };

    preview.setUrl = function(html)
    {
    	// preview.config.el.attr('src', '/template/preview?html='+html);
    	preview.config.el.contents().find('#wrapper').html(html);
    }

    preview.refresh = function(){
        // preview.config.el.attr( 'src', function ( i, val ) { return val; });
        preview.setHeight();
    };



	/*=================================================

    ui

    =================================================*/
	
	var pageUI = pageUI || {};
	
	pageUI.init = function()
	{
		// // snap back into place
		// build.config.el.sortable({
		// 	revert:true
		// });

		$(build.config.ul).sortable({
			revert: false
		});

		// make the sources draggable
		// connect them to the build table
		sources.config.el.draggable({
			connectToSortable: build.config.ul,
			helper: "clone",
			revert: "invalid"
		});

		// make the trash div droppable
		// delete elements on drop
		trash.config.el.droppable({
			drop: function(event, ui){
				ui.draggable.remove();
			}
		});

		// // // disable text selection on li
		$( "ul, li" ).disableSelection();

	}

	/*=================================================

    query

    =================================================*/
	
	var templateBuildQuery = templateBuildQuery || {};
	
	templateBuildQuery.create = function()
	{
		var query = [];
		$.each( $('#build li'), function(index, value){
			var name = $(value).data('blockId');
			if(name != ""){
				query.push(name);
			}
		});
		return query;

	}

	templateBuildQuery.makeRequest = function(query)
	{
		$.post('/api/template/make', {values: query } )
			.done(function(data){
				generate.config.el.val(data);
				preview.setUrl(data);
				preview.refresh();
			});
		
	}


	/*=================================================

    init

    =================================================*/

    preview.init();
    pageUI.init();

});

</script>

@endsection