$('document').ready(function(){
	

    /*=================================================

    Delete

    =================================================*/
    var siteDelete = siteDelete || {};

    siteDelete.listeners = function(){
        $('body').on('click', 'button[data-action="site-delete"]', function(e){
            $.blockUI();
            siteDelete.do(this);
            e.preventDefault();
        });
    };

    siteDelete.do = function(ele){
        var url = $(ele).attr('href');
        console.log(url);
        $.ajax({
            type: 'DELETE',
            url: url,
            success: function(xhr, response){
                window.location = xhr.redirect_url;
            },
            error: function(xhr, response){
                console.log("err");
            }
        });
    };

    siteDelete.init = function(){
        siteDelete.listeners();
    };


    siteDelete.init();


});