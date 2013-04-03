$('document').ready(function(){
	
   /*=================================================

    Handle preview pane

    =================================================*/

    var preview = preview || {};

    preview.config = {
    	el : $('#preview_pane iframe')
    };

    preview.listeners = function()
    {
    	$('body').on('click', '*[data-action="preview"]', function(e){
      		$.blockUI();
            preview.populate(this);
            e.preventDefault();
        });
         preview.config.el.on('load', function(){
            preview.setHeight();
            $.unblockUI();
        });
    }

    preview.populate = function(ele){
    	var url = $(ele).parents('tr').data('previewUrl');
    	preview.config.el.attr('src', url);
    };

    preview.setHeight = function(){
        var height = preview.config.el.contents().height();
        preview.config.el.attr('height', height);
    };

    preview.init = function(){
    	preview.listeners();
    };

    /*=================================================

    Delete

    =================================================*/
    var nlDelete = nlDelete || {};

    nlDelete.listeners = function(){
        $('body').on('click', 'button[data-action="newsletter-delete"]', function(e){
            var confirmDelete = confirm("sure you want to delete?");
            if(confirmDelete = false){
                nlDelete.do();
                e.preventDefault();
            } else {
                $(this).button('reset')
            }
        });
    };

    nlDelete.do = function(ele){
        var parent = $(ele).parents('tr');
        var url = parent.data('newsletterUrl');
        $.ajax({
            type: 'DELETE',
            url: url,
            success: function(xhr, response){
                parent.fadeOut();
                preview.config.el.attr('src', '');
            }
        });
    };

    nlDelete.init = function(){
        nlDelete.listeners();
    };


    nlDelete.init();
    preview.init();


});