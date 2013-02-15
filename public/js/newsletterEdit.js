$(document).ready(function(){


    // is it used by more than one module?!
    var common = common || {};
    common.config = {
        dataContainer: $('#data_container'),
        modalContainer: $('#modal_container'),
        templateId: (function(){return $('#data_container').data('id');})()
    };

    /*=================================================

    Fill Sidebar

    =================================================*/
    var sidebar = sidebar || {};

    sidebar.config = {
        el : $('#snippets'),
        list: $('#snippets').find('ul'),
        getAllUrl: common.config.dataContainer.data('template-snippets'),
        liTemplate: $('#hb_sidebar_snippet_li').html(),
        addNewButton: $('#snippets > a.btn'),
        singleSnippetUrl: common.config.dataContainer.data('single-snippet'),
        snippetEditTemplate: $('#snippet_edit_modal_template'),
        loading: $('#snippets .loading')
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
                    var section = title.match(/^section_(.*?)_(.*?)$/)[1];
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
        sidebar.config.loading.show();
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
                var li = sidebar.createLi(data);
                $(list).append(li);
            });

        $(list).prepend('<li class="nav-header">'+title+'</li>');
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
       sidebar.config.loading.hide();
    };



    /*=================================================

     Snippets

     =================================================*/
    sidebar.snippet = sidebar.snippet || {};

    sidebar.listeners = function(){
        
        $('body').on('click', 'a[data-action="add-new-snippet"]', function(e){
            sidebar.snippet.new();
            e.preventDefault();
        });
        
        $('body').on('click', '#snippets ul li a', function(e){
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

    };



    /*=================================================

     Add New Snippet

     =================================================*/
    sidebar.snippet.new = function(){
        var html = sidebar.snippet.new.populate();
    };

    sidebar.snippet.new.populate = function(){
        var src      = $('#snippet_new_modal_template').html();
        var template = Handlebars.compile(src);
        var html     = template({title: 'New Snippet', id: common.config.templateId});
        common.config.modalContainer.html(html);
        $('#snippet_new_modal').modal('toggle');
    };

    sidebar.snippet.new.add = function(ele){
        var data    = $(ele).serialize();
        var request = $.ajax({
            type:'POST',
            url: sidebar.config.singleSnippetUrl,
            data: data,
            success: function(xhr, response){
                $('#snippet_new_modal').modal('toggle');
            }
        });
        request.complete(function(){
            sidebar.fill();
        });
    };



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
        $('#snippet_edit_modal').modal('toggle');
    };

    sidebar.snippet.edit.submitForm = function(ele){
        var data    = $(ele).serialize();
        var url     = $(ele).attr('action');
        var request = $.ajax({
            type: 'PUT',
            data: data,
            url: url,
            success: function(xhr, response){
                $('#snippet_edit_modal').modal('toggle');           
            }
        });
    };



    /*=================================================

    Delete Snippet

    =================================================*/
    sidebar.snippet.delete = function(ele){
        var id      = $(ele).data('id');
        var request = $.ajax({
            url: sidebar.config.singleSnippetUrl + id,
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
        loader      : $('#template_code').siblings('.loading'),
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
        code.config.loader.show();

        var request = $.ajax({
            type: 'GET',
            url: code.config.url,
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
        code.config.codeBox.html(html);
        code.config.rawCodeBox.html(html);
        prettyPrint();
        code.config.loader.hide();
    };


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
            url: template.config.url,
            success: function(xhr, response){
                template.edit(xhr);
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
            url: $('#data_container').data('template'),
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
            nlDelete.do();
            e.preventDefault();
        });
    };

    nlDelete.do = function(){
        var url = nlDelete.config.url;
        $.ajax({
            type: 'DELETE',
            url: url,
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

});