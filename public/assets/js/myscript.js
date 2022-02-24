/*glopal $, alert, console*/

$(function(){

    'use strict';
    
    // the main menu
    $("header .container > .row > div:nth-of-type(2) > div span").click(function(){
        $(".menu-links").show(500);
    });
    $(".menu-links .closbtn").click(function(){
        $(".menu-links").hide(500);
    });
    

    
    
    // the bitton to top
    var scrollButton = $("#button-top");
    $(window).scroll(function(){
        if ( $(this).scrollTop() >= 700){
            scrollButton.show();
        }
        else{
            scrollButton.hide();
        }
    });
    scrollButton.click(function(){  
        $("html, body").animate({ scrollTop: 0}, 100);
    });
    
    // multi-parts for payment page for paymethod section
    $('.parttime .container .parttime-slider .parttime-hourlyrate > .row > div ul li').click(function(){
        $(this).addClass('selected').siblings().removeClass('selected');
        $(".parttime .container .parttime-slider .parttime-hourlyrate > .row > div .complex").hide();
        $("." + $(this).data('class')).fadeIn(500);
    });
    
    
    // sliding toggle at modal-dashboard-employer
    $(".current-header").click(function(){
        $(this).next().slideToggle(500);
        $(this).parent().siblings().find(".current-details").slideUp(500);
    }); 
    
    //parttime popups
    $(".find-part-time-employee,.find-full-time-employee").click(function(){
        $(".parttime").css('visibility','visible');
    });
    $(".parttime-slider-closebtn, .parttime-verifay").click(function(){
        $(".parttime").css('visibility','hidden');
    });  
    
    
//    $(".find-part-time-employee").click(function(){
//        $(".parttime").slideDown(500);
//    });
//    $(".parttime-slider-closebtn").click(function(){
//        $(".parttime").slideUp(500);
//    });
			
});