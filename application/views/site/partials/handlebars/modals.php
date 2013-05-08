<script  id="snippet_edit_modal_template" type="text/x-handlebars-template">
	<div id="snippet_edit_modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">{{title}}</h3>
		</div>
		<div class="modal-body">
		<div class="modal_error_container"></div>
		<form id="snippet_edit_form" method="POST" action="<?php echo URL::to_route('api_get_single_snippet') ?>/{{id}}" accept-charset="UTF-8">
					<input type="hidden" name="_method" value="PUT">
					<p><textarea name="value" class="input-block-level">{{value}}</textarea></p>
		</form>
		</div>
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
		 		
			<div class="modal-body">
				
				<div class="modal_error_container"></div>

				<form id="snippet_new_form" method="POST" action="<?php echo URL::to_route('newsletters') ?>" accept-charset="UTF-8">
					<input type="hidden" name="newsletter_id" value="{{id}}" />
					<p>
						<?php echo Form::label('title','Title'); ?>
						<input type="text" name="title" class="input-block-level" required />
					</p>

					<p>
						<?php echo Form::label('value','Value'); ?>
						<textarea name="value" class="input-block-level" data-provide="typeahead" data-items="3" data-source="<?php echo $cdn_images; ?>"></textarea>
					</p>
				</form>
			</div>

			<div class="modal-footer">
				<a class="btn" data-dismiss="modal" aria-hidden="true">Cancel</a>
				<button id="snippet_new_submit" class="btn btn-primary">Add</button>
			</div>
	</div>
</script>


<script  id="snippet_new_from_group_modal_template" type="text/x-handlebars-template">
	<div id="snippet_new_modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">{{title}}</h3>
		</div>
		 		
			<div class="modal-body">
				
				<div class="modal_error_container"></div>

				<form id="snippet_new_form" method="POST" action="<?php echo URL::to_route('newsletters') ?>" accept-charset="UTF-8">
					<input type="hidden" name="newsletter_id" value="{{id}}" />
					<p>
						<?php echo Form::label('title','Title'); ?>
						<input type="text" value="section_{{group}}_" name="title" class="input-block-level" required />
					</p>

					<p>
						<?php echo Form::label('value','Value'); ?>
						<textarea name="value" class="input-block-level" data-provide="typeahead" data-items="3" data-source="<?php echo $cdn_images; ?>"></textarea>
					</p>
				</form>
			</div>

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
		<div class="modal-body">
		<div class="modal_error_container"></div>
		<form id="template_edit_form" method="POST" action="" accept-charset="UTF-8">
					<p>
						<?php echo Form::label('title','Title'); ?>
						<input type="text" name="title" value="{{title}}" class="input-block-level" required data-validation-required-message="need a title"/>
					</p>
					<input type="hidden" name="_method" value="PUT" />
					<p><textarea name="template" style="min-height:300px;" class="input-block-level">{{template}}</textarea></p>
		</form>
		</div>
			<div class="modal-footer">
				<a class="btn" data-dismiss="modal" aria-hidden="true">Cancel</a>
				<button id="template_edit_submit" class="btn btn-primary">Save template</button>
			</div>
	</div>
</script>

<script id="template_edit_section" type="text/x-handlebars-template">
		
	<div id="template_edit_section_modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">Update Section</h3>
		</div>

		<div class="modal-body">
		<div class="modal_error_container"></div>
			<form id="section_update" method="POST" action="<?php echo URL::to_route('api_section_group_update'); ?>">
				
				{{{form}}}

				<input type="hidden" name="_method" value="PUT" />
			</form>
		</div>

		<div class="modal-footer">
			<a class="btn" data-dismiss="modal" aria-hidden="true">Cancel</a>
			<button id="template_section_submit" class="btn btn-primary">Update</button>
		</div>

	</div>

</script>

<script id="template_edit_section_snippet" type="text/x-handlebars-template">

	<p>
		<label for="{{title}}">{{title}}</label>
	</p>
	<p>
		<textarea name="{{id}}" class="input-block-level">{{value}}</textarea>
	</p>

</script>

<script type="text/x-handlebars-template" id="alert_template">
	<div class="alert">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		{{message}}
	</div>
</script>

<script type="text/x-handlebars-template" id="snippets_accordian">
<div class="accordion-group">
	<div class="accordion-heading">
		<a class="accordion-toggle" data-toggle="collapse" data-parent="#snippets" href="#snippet_{{groupTitle}}">{{groupTitle}}</a>
		<div class="btn-group pull-right">
			<a class="btn btn-mini" href="#" data-action="edit-section-group" data-group-name="{{groupTitle}}">
				<i class="icon-edit icon"></i>
			</a>
			<a class="btn btn-mini" data-group-name="{{groupTitle}}" data-action="snippet-add-to-group" href="#">
				<i class="icon-plus icon"></i>
			</a>
		</div>
	</div>
	<div id="snippet_{{groupTitle}}" class="accordion-body collapse">
		<div class="accordion-inner">
			<ul class="snippet-section">
			{{#each snippets}}
				<li>
					<span class="snippet_value">[{{this.title}}]</span>
					<a class="single_snippet" data-id="{{this.id}}" href="{{this.id}}">{{shortValue this.value}}</a>
				</li>
			{{/each}}
			</ul>
		</div>
	</div>
</div>	
</script>

<script type="text/x-handlebars-template" id="hb_sidebar_snippet_li">
<div class="accordion-group">
	<div class="accordion-heading">
		<a class="accordion-toggle single_snippet" data-id="{{id}}">{{title}}</a>
		<span class="snippet_value">{{value}}</span>
	</div>
</div>	
</script>
