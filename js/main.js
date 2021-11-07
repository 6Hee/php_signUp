$(document).ready(function(){
    $("#slider").slick({
       infinite : true,
       dots : true,
       slidesToShow : 1,
       slidesToScroll  :1,
       autoplay : true,
       autoplaySpeed : 3000  
    });


    $("#review .slide").each(function(){
        var $star_rel = $(this).find("ul").attr("rel");
        $(this).find("ul li:nth-child("+$star_rel+")").addClass("active").prevAll().addClass("active");
    });


    $(".review_slider").slick({
        infinite : true,
        dots : true,
        slidesToShow : 1,
        slidesToScroll  :1,
        autoplay : true,
        autoplaySpeed : 3000  
    });


});