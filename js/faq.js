function check_input(){
    if(!document.faq_form.subject.value){
        alert("FAQ 게시글 제목을 작성하세요.");
        document.faq_form.subject.focus();
        return;
    }
    if(!document.faq_form.content.value){
        alert("FAQ 게시글 제목을 작성하세요.");
        document.faq_form.content.focus();
        return;
    }

    document.faq_form.submit();

}

