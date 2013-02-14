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
      		preview.populate(this);
            e.preventDefault();
        });
         preview.config.el.on('load', function(){
            preview.setHeight();
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
            nlDelete.do(this);
            e.preventDefault();
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

    /*=================================================

    Sections

    =================================================*/

    nlDelete.init = function(){
        nlDelete.listeners();
    };

    // get data
    // build sections
    // sections are multidimensional arrays
    // normal non group sections are single arrays

    var data = [{"id":147,"title":"title","value":null},{"id":148,"title":"preheader_text","value":null},{"id":149,"title":"section_first_url","value":null},{"id":150,"title":"section_first_title","value":null},{"id":151,"title":"section_first_blurb","value":null},{"id":152,"title":"section_first_hostel_name","value":null},{"id":153,"title":"section_first_hostel_location","value":null},{"id":154,"title":"section_first_hostel_rating","value":null},{"id":155,"title":"section_first_cta","value":null},{"id":156,"title":"section_second_url","value":null},{"id":157,"title":"section_second_title","value":null},{"id":158,"title":"section_second_blurb","value":null},{"id":159,"title":"section_second_hostel_name","value":null},{"id":160,"title":"section_second_hostel_location","value":null},{"id":161,"title":"section_second_hostel_rating","value":null},{"id":162,"title":"section_second_cta","value":null},{"id":163,"title":"button_url","value":null},{"id":164,"title":"button_cta","value":null}];
    
    

    function testing(data){


        var sections = [];
        $.each(data, function(index, value){
            var title = value.title;

            if(title.match(/^section_.*?_.*?$/) != null){
                
                // get section mame
                var section = title.match(/^section_(.*?)_(.*?)$/)[1];
                
                // check it doesn't already exists
                var check = $.inArray(section, sections);

                    // if it doens't exists, create its
                    if(check == -1){
                        sections.push(section);
                    };

            };

        });
        
        console.log("section: " + sections);

    };

    nlDelete.init();
    preview.init();
    testing();

});