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
                            + "<span class='typeaheadSite'>" + results[i]['site_title'] + "</span>"
                            + results[i]['title']
                            + "<span class='typeaheadDate'>" + date.parseFromDb(results[i]['created_at']) + "</span>"
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

    date

    =================================================*/
    Date.prototype.monthNames = [
        "January", "February", "March",
        "April", "May", "June",
        "July", "August", "September",
        "October", "November", "December"
    ];

    Date.prototype.getMonthName = function() {
        return this.monthNames[this.getMonth()];
    };

    Date.prototype.getShortMonthName = function () {
        return this.getMonthName().substr(0, 3);
    };

    var date = date || {};

    date.parseFromDb = function(date){
        var dbDate    = new Date(date);
        return dbDate.getUTCDate() + " " + dbDate.getMonthName() + " " + dbDate.getUTCFullYear() ;
    }

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

