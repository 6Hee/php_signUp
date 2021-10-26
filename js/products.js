function check_input(){
    if(!document.product_form.title.value){
        alert("프로그램의 타이틀을 작성하세요.");
        document.product_form.title.focus();

        return;
    }
    if(!document.product_form.sub.value){
        alert("프로그램의 서브 타이틀을 작성하세요.");
        document.product_form.sub.focus();

        return;
    }
    if(!document.product_form.content.value){
        alert("프로그램의 상세 내용을 작성하세요.");
        document.product_form.content.focus();

        return;
    }
    if(!document.product_form.price.value){
        alert("프로그램의 시간당 가격을 작성하세요.");
        document.product_form.price.focus();

        return;
    }
    document.product_form.submit();
}