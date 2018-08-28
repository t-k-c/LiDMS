$(document).ready(function(){
 registerOperations();
 hideLoader();
});
function registerOperations(){
        $('.collapsible').collapsible({
            accordion: true
        });
    tippy('.post-options',{
        html:'.post-options-tooltip',
        theme:'light',
        arrow:true,
        animation:'scale',
        interactive:true,
        trigger: 'click'
    });
    FilePond.parse(document.body);
        $('.modal').modal();
        $('.date-field').pickadate();
    $('input.town-autocomplete').autocomplete({
        data: {
            "Apple": null,
            "Microsoft": null,
            "Google": 'http://placehold.it/250x250'
        },
        limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
        onAutocomplete: function(val) {
            // Callback function when value is autcompleted.
        },
        minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
    });

    /* $(".ajax-call").loadingbar({
     replaceURL: false,
     target: "#loadingbar-frame",
     direction: "right",
     async: true,
     complete: function(xhr, text) {},
     cache: true,
     error: function(xhr, text, e) {},
     global: true,
     headers: {},
     statusCode: {},
     success: function(data, text, xhr) {},
     dataType: "html",
     done: function(data) {}
 });*/
}
function showLoader(){
    $('.loader').fadeIn(360);
}
function hideLoader(){
    $('.loader').fadeOut(360);
}
function error_msg(title,text){
    alertify
        .alert(title,text, function(){
            /*alertify.message('OK');*/
        });
}

