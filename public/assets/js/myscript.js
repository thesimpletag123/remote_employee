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
    $(".modal-dashboard-employer .modal-body .employer-dashboard-body .current-employees-box .current-header").click(function(){
        $(this).siblings(".modal-dashboard-employer .modal-body .employer-dashboard-body .current-employees-box .current-details").slideToggle(500);
    });
    
    
    //parttime popups
    $(".find-part-time-employee,.find-full-time-employee").click(function(){
        $(".parttime").css({"top":"0px"});
    });
    $(".parttime-slider-closebtn, .parttime-verifay").click(function(){
        $(".parttime").css({"top":"-200vh"});
    });  
    
    
//    $(".find-part-time-employee").click(function(){
//        $(".parttime").slideDown(500);
//    });
//    $(".parttime-slider-closebtn").click(function(){
//        $(".parttime").slideUp(500);
//    });
			
});