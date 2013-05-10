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
		<div class="span3">
			<h4>sources</h4>
			<ul class="nav nav-tabs nav-stacked" id="sources">
				@foreach($blocks as $block)
				<li data-block-id="{{$block->id}}"><a href="#">{{$block->title}}</a></li>
				@endforeach
			</ul>
		</div>

		{{-- ------------------------		Build		------------------------ --}}
		<div class="span3">

			<div id="trash" class="well">
				<i class="icon-trash"></i>  trash
			</div>

			<h4>build</h4>
			<ul id="build" class="nav nav-tabs nav-stacked"></ul>
		</div>


		{{-- ------------------------		Preview		------------------------ --}}
		<div class="span6">
			<h4>generated</h4>
			<div id="query"></div>
			<div class="btn-group">
				<a data-action="generate-template" class="btn btn-primary">do</a>
			</div>
			<textarea id="output" cols="30" rows="10"></textarea>
		</div>
		

	</div>

@endsection

@section('handlebars')
<script>

$(function(){
	
	$('body').on('click', 'a[data-action="generate-template"]', function(e){

        var query = createQuery();
        console.log(query);

        $.post('/template/make', {values: query } )
        
        .done(function(data){
        	$('#output').val(data);
        });

        e.preventDefault();
    });

	$( "#build" ).sortable({
		revert: true
	});


	$( "#sources li" ).draggable({
		connectToSortable: "#build",
		helper: "clone",
		revert: "invalid"
	});

	$('#trash').droppable({
		drop: function(event, ui){
			ui.draggable.remove();
		}
	});

	$( "ul, li" ).disableSelection();

	function createQuery(){
		var build = $('#build li');
		var query = [];
		$.each(build, function(index, value){
			var name = $(value).data('blockId');
			if(name != ""){
				query.push(name);
			}
		});
		return query;
	}

});

</script>

@endsection