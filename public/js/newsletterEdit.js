$(document).ready(function(){

    // is it used by more than one module?!
    var common = common || {};
    common.config = {
        dataContainer : $('#data_container'),
        modalContainer: $('#modal_container'),
        templateId    : (function(){return $('#data_container').data('id');})()
    };


    /*=================================================

    Fill Sidebar

    =================================================*/
    var sidebar = sidebar || {};

    sidebar.config = {
        el                 : $('#snippets'),
        list               : $('#snippets').find('ul'),
        getAllUrl          : common.config.dataContainer.data('template-snippets'),
        liTemplate         : $('#hb_sidebar_snippet_li').html(),
        addNewButton       : $('#snippets > a.btn'),
        singleSnippetUrl   : common.config.dataContainer.data('single-snippet'),
        snippetEditTemplate: $('#snippet_edit_modal_template'),
    };

    sidebar.init = function(){
        sidebar.listeners();
        sidebar.fill();
    };

    sidebar.sortData = function(data){
        var dataObject = new Object();

            $.each(data, function(index, snippet){
                var title = snippet.title;

                if(title.match(/^section_.*?_.*?$/) != null){
                    // get section mame
                    var section      = title.match(/^section_(.*?)_(.*?)$/)[1];
                    var sectionTitle = title.match(/^section_(.*?)_(.*?)$/)[2];

                    // check it doesn't already exists
                    if (dataObject.hasOwnProperty(section) == false) {
                        // create separate object for each section
                        dataObject[section] = new Object();
                    };

                    dataObject[section][sectionTitle] = snippet.id;

                } else {
                    // doesn't have section attached
                    dataObject[title] = snippet.id;
                }

            });
    
        return dataObject;

    };

    sidebar.fill = function(){
        $.blockUI();
        $.get(sidebar.config.getAllUrl, function(data){
            var sorted = sidebar.sortData(data); // gets back object with all data
            sidebar.createList(sorted);
        });
    };

    sidebar.createList = function(data){
        var list = document.createDocumentFragment();

        $.each(data, function(title, value){
            if(typeof value == "object"){
                var ul = sidebar.createFromObject(title, value);
                $(list).append(ul);
            } else {
                var li = sidebar.createFromString(title,value);
                $(list).append(li);
            }
        });

        sidebar.attach(list);

    };

    sidebar.createFromObject = function(title, data){
        // do the list
        var list = document.createDocumentFragment('div');
            $.each(data, function(title, id){
                var data = {title: title, id: id};
                var li   = sidebar.createLi(data);
                $(list).append(li);
            });

        $(list).prepend('<li class="nav-header"><a href="#" data-action="edit-section-group">'+title+'</a></li>');
        $(list).append('<li class="divider"></li>');
        
        return list;

    };

    sidebar.createFromString = function(title, value){
        var data = {id: value, title: title};
        var html = sidebar.createLi(data);
        return html;
    };

    sidebar.createLi = function(snippet){
        var data = {
            id: snippet.id,
            title: snippet.title.replace('_', ' ')
        }
        var src      = sidebar.config.liTemplate;
        var template = Handlebars.compile(src);
        var html     = template(data);
        return html;
    };

    sidebar.attach = function(html){
       sidebar.config.list.html(html);
       $.unblockUI();
    };



    /*=================================================

    Delete Variation

    =================================================*/
    var variation = variations || {};

    variation.listeners = function(){
        $('body').on('click', 'a[data-action="delete-variation"]', function(e){
            variation.delete(this);
            e.preventDefault();
        });
    }

    variation.delete = function(ele){
        $.blockUI();
        $.ajax({
            url : $(ele).attr('href'),
            type: 'DELETE',
            success: function(){
                window.location = $('#data_container').data('default');
            }
        });
    }

    variation.init = function(){
        variation.listeners();
    }



    /*=================================================

     Snippets

     =================================================*/
    sidebar.snippet = sidebar.snippet || {};

    sidebar.listeners = function(){
        
        $('body').on('click', 'a[data-action="add-new-snippet"]', function(e){
            sidebar.snippet.new();
            e.preventDefault();
        });
        
        $('body').on('click', '#snippets ul li.single_snippet a', function(e){
            $.blockUI();
            sidebar.snippet.edit(this);
            e.preventDefault();
        });
        
        $('body').on('click', '#snippet_delete_submit', function(e){
            sidebar.snippet.delete(this);
            e.preventDefault();
        });

        $('body').on('click', '#snippet_new_submit', function(e){
            $('#snippet_new_form').submit();
            e.preventDefault();
        });

        $('body').on('submit', '#snippet_new_form', function(e){
            sidebar.snippet.new.add(this);
            e.preventDefault();
        });

        $('body').on('click', '#snippet_edit_submit', function(e){
            $('#snippet_edit_form').submit();
            e.preventDefault();
        });

        $('body').on('submit', '#snippet_edit_form', function(e){
            sidebar.snippet.edit.submitForm(this);
            e.preventDefault();
        });

        $('body').on('click', 'a[data-action="edit-section-group"]', function(e){
            sidebar.sectionGroup.request(this);
            e.preventDefault();
        });

        $('body').on('click', '#template_section_submit', function(e){
            $('#section_update').submit();
            e.preventDefault();
        });

        $('body').on('submit', '#section_update', function(e){
            sidebar.sectionGroup.parse(this);
            e.preventDefault();
        });

    };


    /*=================================================

     Edit group section

     =================================================*/
     sidebar.sectionGroup = sidebar.sectionGroup || {};

     sidebar.sectionGroup.config = {
        baseUrl               : common.config.dataContainer.data('siteBase'),
        templateSection       : '#template_edit_section',
        templateSectionSnippet: '#template_edit_section_snippet',
        tempalteSectionModal  : '#template_edit_section_modal'
     };

     sidebar.sectionGroup.request = function(ele){
        $.blockUI();
        var sectionName = $(ele).html();
        var url         = sidebar.sectionGroup.config.baseUrl + '/api/snippets/section/' + common.config.templateId + '/' + sectionName + '/' + common.config.dataContainer.data('variation');
        $.get(url, function(data){
            sidebar.sectionGroup.createForm(data);
        });
     }

     sidebar.sectionGroup.parse = function(ele){
        var snippets = $(ele).find('textarea');
        $.each(snippets, function(index, val) {
            var data = {
                id   :$(val).attr('name'),
                value:$(val).val()
            }
            sidebar.sectionGroup.update(data);
        });
        $(sidebar.sectionGroup.config.tempalteSectionModal).modal('toggle');
        code.request();
        preview.refresh();
     }

     sidebar.sectionGroup.update = function(data){
        var request = $.ajax({
            type: 'PUT',
            data: data,
            url : sidebar.config.singleSnippetUrl + data.id,
            success: function(xhr, response){
                if(!xhr.status)
                {
                    error.modal(xhr.message);
                } else {
                    
                }
            }
        });
     }

     sidebar.sectionGroup.createForm = function(data){
        
        var snippetInput = document.createDocumentFragment();

        $.each(data, function(index, val) {
             
             var cleanTitle = val.title.match(/^section_(.*?)_(.*?)$/)[2];

             var data = ({
                title: cleanTitle,
                id   : val.id,
                value: val.value
             });
             var src      = $(sidebar.sectionGroup.config.templateSectionSnippet).html();
             var template = Handlebars.compile(src);
             var html     = template(data);
             $(snippetInput).append(html);
        });

        var completeForm     = $('<div>').html(snippetInput).html();
        var formHtmlsrc      = $(sidebar.sectionGroup.config.templateSection).html();
        var formHtmlTemplate = Handlebars.compile(formHtmlsrc);
        var formHtmlHtml     = formHtmlTemplate({form: completeForm});

        common.config.modalContainer.html(formHtmlHtml);
        $(sidebar.sectionGroup.config.tempalteSectionModal).modal('toggle');

        $.unblockUI();
     }


    /*=================================================

     Add Snippet

     =================================================*/
    sidebar.snippet.new = function(){
        var html = sidebar.snippet.new.populate();
    };

    sidebar.snippet.new.populate = function(){
        var variation = common.config.dataContainer.data('variation');
        var src       = $('#snippet_new_modal_template').html();
        var template  = Handlebars.compile(src);
        var html      = template({title: 'New Snippet', id: common.config.templateId});
        common.config.modalContainer.html(html);
        $('#snippet_new_modal').modal('toggle');
    };

    sidebar.snippet.new.add = function(ele){
        var data    = $(ele).serialize();
        var request = $.ajax({
            type:'POST',
            url : sidebar.config.singleSnippetUrl,
            data: data,
            success: function(xhr, response){
                if(!xhr.status)
                {
                    error.modal(xhr.message);
                } else {
                    $('#snippet_new_modal').modal('toggle');
                    sidebar.fill();
                }
            }
        });

    };

    
    /*=================================================

    Errors

    =================================================*/
    var error = error || {};

    error.modal = function(data){
        var messages = document.createDocumentFragment();
        $.each(data, function(index, val) {
             var html = error.single(data);
             $(messages).append(html);
        });
        $('.modal_error_container').html(messages);
    }

    error.single = function(message){
        var data     = {message: message};
        var src      = $('#alert_template').html();
        var template = Handlebars.compile(src);
        var html     = template(data);
        return html;
    }


    /*=================================================

    Edit Snippet

    =================================================*/
    sidebar.snippet.edit = function(ele){
        var id = $(ele).data('id');
        sidebar.snippet.edit.request(id);
    };

    sidebar.snippet.edit.request = function(id){
        var request = $.ajax({
            type: 'GET',
            url: sidebar.config.singleSnippetUrl + id,
            success: function(xhr, response){
                sidebar.snippet.edit.populate(xhr);
            }
        });
    };

    sidebar.snippet.edit.populate = function(data){
        var src      = sidebar.config.snippetEditTemplate.html();
        var template = Handlebars.compile(src);
        var html     = template(data);
        common.config.modalContainer.html(html);
        $.unblockUI();
        $('#snippet_edit_modal').modal('toggle');
    };

    sidebar.snippet.edit.submitForm = function(ele){
        var data    = $(ele).serialize();
        var url     = $(ele).attr('action');
        var request = $.ajax({
            type: 'PUT',
            data: data,
            url : url,
            success: function(xhr, response){
                if(!xhr.status)
                {
                    error.modal(xhr.message);
                } else {
                    $('#snippet_edit_modal').modal('toggle');
                    code.request();
                    preview.refresh();
                }
            }
        });
    };



    /*=================================================

    Delete Snippet

    =================================================*/
    sidebar.snippet.delete = function(ele){
        var id      = $(ele).data('id');
        var request = $.ajax({
            url : sidebar.config.singleSnippetUrl + id,
            type: 'DELETE',
            success: function(){
                $('#snippet_edit_modal').modal('toggle');
            }
        });
        request.complete(function(){
            sidebar.fill();
        });
    };



    /*=================================================

    code view

    =================================================*/
    var code = code || {};

    code.config = {
        container   : $('#template_code'),
        url         : common.config.dataContainer.data('template-html'),
        codeBox     : $('#code'),
        rawCodeBox  : $('#raw_code')
    };

    code.listeners = function(){
        
        $('body').on('click', 'button[data-action="code-refresh"]', function(e){
            code.request();
            preview.refresh();
            e.preventDefault();
        });

    };

    code.request = function(){
        $.blockUI();

        var request = $.ajax({
            type: 'GET',
            url : code.config.url,
        });
        request.complete(function(xhr, response){
            code.populate(xhr.responseText);
        });
    };

    code.init = function(){
        code.listeners();
        code.request();
    };

    code.populate = function(html){
        // code.config.codeBox.html(html);
        code.config.rawCodeBox.html(html);
        $.unblockUI();
    };



    /*=================================================

    quick template settings

    =================================================*/
    var quickTemplate = quickTemplate || {};

    quickTemplate.config = {
        formId: '#quick_template',
        alert : '#quick_template_alert'
    };


    quickTemplate.listeners = function(){

        $(quickTemplate.config.alert).hide();

        $('body').on('change', '#quick_template', function(e){
            quickTemplate.doForm(this);
            e.preventDefault();
        });

        $('body').on('submit', '#quick_template', function(e){
            e.preventDefault();
        });

    };

    quickTemplate

    quickTemplate.doForm = function(ele) {
        var data    = $(ele).serialize();
        var request = $.ajax({
            type: 'PUT',
            url : $('#data_container').data('template'),
            data: data,
            success: function(xhr, response){
                $(quickTemplate.config.alert).fadeIn().delay(1000).fadeOut();
            }
        });
    }

    quickTemplate.init = function(){
        quickTemplate.listeners();
    }

    quickTemplate.init();

    /*=================================================

    template editor

    =================================================*/
    
    var template = template || {};

    template.config = {
        url: common.config.dataContainer.data('template')
    };

    //when edit template button is clicked
    template.listeners = function(){
        
        $('body').on('click', 'button[data-action="template-edit"]', function(e){
            $.blockUI();
            template.request();
            e.preventDefault();
        });

        $('body').on('click', '#template_edit_submit', function(e){
            $('#template_edit_form').submit();
            e.preventDefault();
        });

        $('body').on('submit', '#template_edit_form', function(e){
            template.formSubmit(this);
            e.preventDefault();
        });


    };

    // get the template code
    template.request = function(){
        var request = $.ajax({
            type: 'GET',
            url : template.config.url,
            success: function(xhr, response){
                template.edit(xhr);
                $.unblockUI();
            }
        });
    };

    // populate the form
    template.edit = function(xhr){
        var data     = {template: xhr.template, title: xhr.title};
        var src      = $('#template_edit_modal_template').html();
        var template = Handlebars.compile(src);
        var html     = template(data);
        common.config.modalContainer.html(html);
        $('#template_edit_modal_modal').modal('toggle');
    };

    template.init = function(){
        template.listeners();
    };

    template.formSubmit = function(ele){
        var data    = $(ele).serialize();
        var request = $.ajax({
            type: 'PUT',
            url : $('#data_container').data('template'),
            data: data,
            success: function(xhr, response){
            }
        });
        request.complete(function(){
            $('#template_edit_modal_modal').modal('toggle');
        });
    };


    /*=================================================

    preview pane

    =================================================*/
    var preview = preview || {};

    preview.config = {
        el: $('#template_preview iframe')
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

    preview.refresh = function(){
        preview.config.el.attr( 'src', function ( i, val ) { return val; });
        preview.setHeight();
    };


    /*=================================================

    Delete

    =================================================*/
    var nlDelete = nlDelete || {};

    nlDelete.config = {
        url: common.config.dataContainer.data('template'),
        base: common.config.dataContainer.data('baseUrl')
    };

    nlDelete.listeners = function(){
        $('body').on('click', 'button[data-action="newsletter-delete"]', function(e){
            if (confirm('Are you sure you want to delete?')) {
                // Save it!
                nlDelete.do();
            } else {
                // Do nothing!
            }
            e.preventDefault();
        });
    };

    nlDelete.do = function(){
        $.blockUI();
        var url = nlDelete.config.url;
        $.ajax({
            type: 'DELETE',
            url : url,
            success: function(xhr, response){
                window.location = nlDelete.config.base;
            }
        })
    };

    nlDelete.init = function(){
        nlDelete.listeners();
    };


    nlDelete.init();
    sidebar.init();
    code.init();
    template.init();
    preview.init();
    variations.init();

});