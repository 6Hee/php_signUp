$(document).ready(function(){

    var list_num = $(".faq_list").attr("data-listNum");
    console.log(list_num);

    $(".list_detail").eq(list_num).find(".answer").show();
    $(".list_detail").eq(list_num).find("span").addClass("active").text("-");





    $(".list_detail span").click(function(){
        var $active = $(this).hasClass("active");
        console.log($active);

        if($active == false){
            $(this).addClass("active");
            $(this).closest(".list_detail").find(".answer").slideDown();
            $(this).text("－");
        }else{
            $(this).removeClass("active");
            $(this).closest(".list_detail").find(".answer").slideUp();
            $(this).text("＋");
        }

        //return false;
    });

});