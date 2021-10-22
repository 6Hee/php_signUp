document.board_form.subject.focus();

function check_input(){
    if(!document.board_form.subject.value){
        alert("게시글 제목을 작성하세요.");
        document.board_form.subject.focus();

        return
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




});