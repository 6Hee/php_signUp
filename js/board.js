document.board_form.subject.focus();

function check_input(){
    if(!document.board_form.subject.value){
        alert("게시글 제목을 작성하세요.");
        document.board_form.subject.focus();
        return;
    }

    if(!document.board_form.content.value){
        alert("게시글 내용을 작성하세요.");
        document.board_form.content.focus();

        return;
    }


    document.board_form.submit();
}




//JQuery 영역
$(document).ready(function(){
    //수정 파트에서 일반 게시글과 공지 게시글의 구분
    var $cur_selState = $("select").attr("state");
    if($cur_selState == "일반 게시글"){
        $("select option").removeAttr("selected");
        $("select option:eq(0)").attr("selected", "selected");
    }else if($cur_selState == "공지 게시글"){
        $("select option").removeAttr("selected");
        $("select option:eq(1)").attr("selected", "selected");
    }

    $(document).on("click", ".upload", function(){
        $(this).next().hide();
    });



});