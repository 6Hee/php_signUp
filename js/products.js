var oEditors = [];
nhn.husky.EZCreator.createInIFrame({
    oAppRef: oEditors,
    elPlaceHolder: "detail",
    sSkinURI: "./nse_files/SmartEditor2Skin.html",
    fCreator: "createSEditor2"
});


function check_input(elClickedObj){
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
        alert("프로그램의 간략소개를 작성하세요.");
        document.product_form.content.focus();
        return;
    }
    if(!document.product_form.price.value){
        alert("프로그램의 시간당 가격을 작성하세요.");
        document.product_form.price.focus();
        return;
    }
    document.product_form.submit();

    // 에디터의 내용이 textarea에 적용됩니다.
    oEditors.getById["detail"].exec("UPDATE_CONTENTS_FIELD", []);

    try {
        elClickedObj.form.submit();
    } catch(e) {}
}

setTimeout(function(){
    
});
document.querySelector("#smart_editor2").style.width = "100%"