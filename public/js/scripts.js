 $('document').ready(function(){
    
    /*=================================================

    Typeahead

    =================================================*/
    var autosep = '#';
    $('#type').typeahead({
       
        items: 10,
        minLength: 0,
        
        source: function(query, process){
            return $.ajax({
                url: '/api/newsletters/search',
                type: 'GET',
                data: {query: query},
                dataType: 'json',
                success: function(results){

                    var data = new Array();
                    for (var i = results.length - 1; i >= 0; i--) {
                        data.push(
                              results[i]['id']
                            + autosep
                            + results[i]['title']
                        );
                    };
                    return process(data);

                }
            })

        },

        highlighter: function(item) {
            var parts = item.split(autosep);
            parts.shift();
            return parts.join(autosep);
        },

        updater: function(item) {
            var parts = item.split(autosep);
            var url = '/newsletters/' + parts.shift();
            window.location = url; 
        }

    });

    /*=================================================

    Disabled button action

    =================================================*/
    $('body').on('click', 'button[data-loading-text]', function(e){
        $(this).button('loading');
    });


    /*=================================================

    Block UI customization

    =================================================*/
    $.blockUI.defaults.css.backgroundColor = 'none';
    $.blockUI.defaults.css.border = 'none';
    $.blockUI.defaults.css.color = '#fff';
    $.blockUI.defaults.message = '<h3>loading...</h3>';
    $.blockUI.defaults.overlayCSS.opacity = 0.7;


});

