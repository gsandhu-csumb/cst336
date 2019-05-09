/* global $ */
$(function(){
    var path = window.location.pathname;
    $('.navigation-bar a').each(function(){
        if($(this).attr('href') == path || $(this).attr("other") == path){
            $(this).addClass('active');
        }
    });

    $('.navigation-bar').last().addClass("navigation-bar-last");
});