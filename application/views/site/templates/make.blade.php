@layout('site.master')

@section('title')
	Make Template
@endsection

@section('main')

<style>
	#sources, #build {
		margin-left: 0;
		list-style-type: none;
	}
	#sources li, #build li {
	    width: 100%;
	    cursor: move;
	    border:1px dotted #ccc;
	    padding:5px;
	    margin: 3px 0;
	}
</style>

	@render('site.partials.alerts')
	
	<div class="row-fluid">

		{{-- ------------------------		Sources		------------------------ --}}
		<div class="span3">
			<h4>sources</h4>
			<ul id="sources">
				<li data-special-id="64"><a href="#">header</a></li>
				<li><a href="#">article</a></li>
				<li><a href="#">article two columns</a></li>
				<li><a href="#">footer</a></li>
			</ul>

		</div>

		{{-- ------------------------		Structure		------------------------ --}}
		<div class="span3">
			<h4>build</h4>
			<ul id="build">
				<li><a href="#">header</a></li>
				<li><a href="#">article</a></li>
				<li><a href="#">article two columns</a></li>
				<li><a href="#">footer</a></li>
			</ul>
		</div>


		{{-- ------------------------		Preview		------------------------ --}}
		<div class="span6">
			<h4>generated</h4>
		</div>
		

	</div>

@endsection

@section('handlebars')
<script>

$('ul#build').sortable();

var items = $( "#sources li" ).draggable({
	connectToSortable: "ul#build",
	revert: false
});

var draggable_data = items.data('draggable');
items.draggable('destroy');
items.data('draggable', draggable_data);



</script>
@endsection