$(document).ready(function(){

    $(document).on('click', 'a[data-action="log"]', function(e){
        snippet.doRender();
    })

    /***************************************************************
     *	Disable all forms
     ***************************************************************/
    $('body').on('submit', 'form', function (event) {
        return false;
    });

    /***************************************************************
     *	DOM elements
     ***************************************************************/
    (function(common, $, undefined){

        common.modalContainer           = '#modal_container';

        //edit snippet modal
        common.snippetEditModal             = '#snippet_edit_modal';
        common.snippetEditModalTemplate     = $('#snippet_edit_modal_template');
        common.snippetEditModalSubmit       = "#snippet_edit_submit";
        common.snippetEditModalFormID       = '#snippet_edit_form';
        common.snippetEditModalDeleteSubmit = "#snippet_delete_submit";

        //new snippet modal
        common.snippetNewModal         = '#snippet_new_modal';
        common.snippetNewModalTemplate = $('#snippet_new_modal_template');
        common.snippetNewModalSubmit   = "#snippet_new_submit";
        common.snippetNewModalFormID   = '#snippet_new_form';

        //newsletter template modal
        common.newsletterTemplateEditModal         = '#newsletter_template_edit_modal';
        common.newsletterTemplateEditModalTemplate = $('#newsletter_template_edit_modal_template');
        common.newsletterTemplateEditModalSubmit   = "#newsletter_template_edit_submit";
        common.newsletterTemplateEditModalFormID   = '#newsletter_template_edit_form';

        //snippets sidebar
        common.snippetsLink   = $('#snippets');

    })(window.common = window.common || {}, jQuery);


    /***************************************************************
     *	Control Snippets
     ***************************************************************/
    (function(snippet, $, undefined){

        snippet.doRender = function(){

            var snippetListId      = common.snippetsLink.find('ul');
            var snippetListAjaxUrl = snippetListId.attr('data-url');
            var snippetLiTemplate  = $('#snippet_sidebar').html();

            //get the items
            var request = $.ajax({
                type: 'GET',
                url: snippetListAjaxUrl,
                success: function(xhr, response){
                    createList(xhr);
                }
            });

            //turn into list
            var createList = function(items){

                var list = document.createDocumentFragment();
                $.each(items, function(index, item){
                    var item = makeListItem(item.attributes);
                    $(list).append(item);
                });
                attachToDom(list);
            };

            var attachToDom = function(list){
                snippetListId.html(list);
            };

            var makeListItem = function(data)
            {
                var src = snippetLiTemplate;
                var template = Handlebars.compile(src);
                var data =  {title: data.title, id: data.id};
                var html = template(data);
                return html;
            };

        };

        var destroy = function(){
            common.snippetsLink.find('ul').empty();
        };

        common.snippetsLink.on('click', 'a', function(e){

            //url to post to
            var url = $(this).attr('data-url');

            // do ajax request
            var json = (function(){
                var json = null;
                $.ajax({
                    'async': false,
                    'global': false,
                    'url': url,
                    success: function(data, response){
                        json = data;
                    }
                });
                return json.attributes;
            })();

            // send json to form generator
            var modal_html = editor.populate(json);

            //put html in modal
            $(common.modalContainer).html(modal_html);

            event.preventDefault();
            event.stopPropagation();

            $(common.snippetEditModal).modal('toggle');

        });



        /***************************************************************
         *	add snippet
         ***************************************************************/
        var addSnippetButton = $('#snippet_add_button');

        addSnippetButton.on('click', function(){
            var src = common.snippetNewModalTemplate.html();
            var template = Handlebars.compile(src);
            var data = {title: 'Add New'};
            var html = template(data);
            $(common.modalContainer).html(html);
            event.preventDefault();
            event.stopPropagation();
            $(common.snippetNewModal).modal('toggle');
        });

        $('body').on('click', common.snippetNewModalSubmit, function(e){
            $(common.snippetNewModalFormID).submit();
            e.preventDefault();
        });


        /***************************************************************
         *	delete snippet
         ***************************************************************/
        $('body').on('click', common.snippetEditModalDeleteSubmit, function(e){
            deleteSnippet($(this).attr('data-id'));
            e.preventDefault();
        });

        var deleteSnippet = function(id){
            var request = $.ajax({
                type: 'DELETE',
                url: 'http://laravel.dev/snippets/' + id,
                success: function(xhr, response){
                    $(common.snippetEditModal).modal('hide');
                }
            });
            request.complete(function(){
                template.doRender();
                preview.render();
                snippet.doRender();
            });
        };

        $('body').on('submit', common.snippetNewModalFormID, function(){

            var request = $.ajax({
                type: 'POST',
                url:  $(this).attr('action'),
                data: $(this).serialize(),
                success: function(xhr, response){
                    $(common.snippetNewModal).modal('hide');
                },
                error: function(xhr, status, error){
                    message.make('error', 'response');
                }
            });

            request.complete(function(){
                template.doRender();
                preview.render();
                snippet.doRender();
            });

        });

        /***************************************************************
         *	edit snippet
         ***************************************************************/
        $('body').on('click', common.snippetEditModalSubmit, function(e){
            $(common.snippetEditModalFormID).submit();
            e.preventDefault();
        });

        $('body').on('submit', common.snippetEditModalFormID, function(){

            var request = $.ajax({
                type: 'PUT',
                url:  $(this).attr('action'),
                data: $(this).serialize(),
                success: function(xhr, response){
                    $(common.snippetEditModal).modal('hide');
                },
                error: function(xhr, status, error){
                    message.make('error', 'response');
                }
            });

            request.complete(function(){
                template.doRender();
                preview.render();
            });

        });

    })(window.snippet = window.snippet || {}, jQuery);


    /***************************************************************
     *	Handlebar form maker for snippet modal popup
     ***************************************************************/
    (function(editor, $, undefined){

        editor.populate = function(json){
            var src      = common.snippetEditModalTemplate.html();
            var template = Handlebars.compile(src);
            var html     = template(json);
            return html;
        }

    })(window.editor = window.editor || {}, jQuery);


    /***************************************************************
     *	Status Messages
     ***************************************************************/
    (function(message, $, undefined){

        var source     = $('#message_template').html();
        var template   = Handlebars.compile(source);
        var container = $('#message_container');

        message.make = function(type, msg){
            var data = {type: type, message: msg};
            var html = template(data);
            attach(html);
        }

        var attach = function(html){
            container.html(html);
            $('#message').slideDown();
            setTimeout(function(){
                $('#message').slideUp();
            }, 2000);
        }

    })(window.message = window.message || {}, jQuery);


    /***************************************************************
     *	Render Template
     ***************************************************************/
    (function(template, $, undefined){

        prettyPrint();

        var handler = $('#render');
        var previewDiv = $('#preview');
        var templateEditButton = $('#template_edit_button');

        handler.on('click', function(e){
            template.doRender();
            e.preventDefault();
        });

        templateEditButton.on('click', function(e){
            var request = $.ajax({
                type: 'GET',
                url: $(this).attr('data-url'),
                success: function(xhr, response){
                    templateFillModal(xhr.attributes);
                }
            });
            e.preventDefault();
        });

        $('body').on('click', common.newsletterTemplateEditModalSubmit, function(){
            $(common.newsletterTemplateEditModalFormID).submit();
        });

        /***************************************************************
         *	Edit Template
         ***************************************************************/

        var templateFillModal = function(json){
            var src = common.newsletterTemplateEditModalTemplate.html();
            var template = Handlebars.compile(src);
            var modalHtml = template(json);
            $(common.modalContainer).html(modalHtml);
            $(common.newsletterTemplateEditModal).modal('toggle');
        };

        $('body').on('submit', common.newsletterTemplateEditModalFormID, function(){
            var myData = $(this).serialize();
            console.log(myData);
            var request = $.ajax({
                type: 'PUT',
                data: myData,
                url: $(this).attr('action'),
                success: function(xhr, response){
                }
            });

            request.complete(function(){
                $(common.newsletterTemplateEditModal).modal('toggle');
                preview.render();
                template.doRender();
            });

        });

        /***************************************************************
         *	Render Template
         ***************************************************************/
        template.doRender = function()
        {
            previewDiv.empty();

            var request = $.ajax({
                type: 'GET',
                url: handler.attr('data-url'),
                success: function(xhr, response){
                    render(xhr);
                },
                error: function(xhr, status, error){
                    message.make('error', error);
                }
            });

        }

        var render = function(html){
            previewDiv.html(html);
            prettyPrint();
        };



    })(window.template = window.template || {}, jQuery);


    /***************************************************************
     *	Handle the tabs
     ***************************************************************/
    (function(tabs, $, undefined){

        $('a[data-toggle="tab"]').on('show', function (e){
            preview.render();
            template.doRender();
        });

    })(window.tabs = window.tabs || {}, jQuery);


    /***************************************************************
     *	Handle the preview pane
     ***************************************************************/
    (function(preview, $, undefined){

        var previewTab    = $('#template_preview');
        var previewIframe = previewTab.find('iframe');
        var previewSrc    = previewIframe.attr('src');

    })(window.preview = window.preview || {}, jQuery);

    // preview.render();
    snippet.doRender();
    template.doRender();

});