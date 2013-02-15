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
                success: function(data){

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

});
