<script  id="snippet_edit_modal_template" type="text/x-handlebars-template">
	<div id="snippet_edit_modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">{{title}}</h3>
		</div>
		<form id="snippet_edit_form" method="POST" action="<?php echo URL::to_route('api_get_single_snippet') ?>/{{id}}" accept-charset="UTF-8">
			<div class="modal-body">
					<input type="hidden" name="_method" value="PUT">
					<p><textarea name="value" class="input-block-level">{{value}}</textarea></p>
			</div>
		</form>
			<div class="modal-footer">
				<a id="snippet_delete_submit" data-id="{{id}}" class="btn btn-danger" style="float:left" aria-hidden="true"><i class="icon-remove icon-white"></i> Delete</a>
				<a class="btn" data-dismiss="modal" aria-hidden="true">Cancel</a>
				<button id="snippet_edit_submit" class="btn btn-primary">Save changes</button>
			</div>
	</div>
</script>

<script  id="snippet_new_modal_template" type="text/x-handlebars-template">
	<div id="snippet_new_modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">{{title}}</h3>
		</div>
		<form id="snippet_new_form" method="POST" action="<?php echo URL::to_route('newsletters') ?>" accept-charset="UTF-8">
			<div class="modal-body">
					<input type="hidden" name="newsletter_id" value="{{id}}" />
					<p>
						<?php echo Form::label('title','Title'); ?>
						<input type="text" name="title" class="input-block-level" />
					</p>
					<p>
						<?php echo Form::label('value','Value'); ?>
						<textarea name="value" class="input-block-level"></textarea>
					</p>
			</div>
		</form>
			<div class="modal-footer">
				<a class="btn" data-dismiss="modal" aria-hidden="true">Cancel</a>
				<button id="snippet_new_submit" class="btn btn-primary">Add</button>
			</div>
	</div>
</script>

<script  id="template_edit_modal_template" type="text/x-handlebars-template">
	<div id="template_edit_modal_modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">Edit Template</h3>
		</div>
		<form id="template_edit_form" method="POST" action="" accept-charset="UTF-8">
			<div class="modal-body">
					<p>
						<?php echo Form::label('title','Title'); ?>
						<input type="text" name="title" value="{{title}}" class="input-block-level" />
					</p>
					<input type="hidden" name="_method" value="PUT" />
					<p><textarea name="template" class="input-block-level">{{template}}</textarea></p>
			</div>
		</form>
			<div class="modal-footer">
				<a class="btn" data-dismiss="modal" aria-hidden="true">Cancel</a>
				<button id="template_edit_submit" class="btn btn-primary">Save template</button>
			</div>
	</div>
</script>

<script type="text/x-handlebars-template" id="hb_sidebar_snippet_li">
	<li><a data-id="{{id}}" href="#">{{title}}</a></li>
</script>
