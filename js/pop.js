$(document).ready(function(){

    var $pop_active = $("#popup").hasClass("active");

    if($pop_active == true){
        $("body").addClass("overflow"); //최초로 브라우저가 열리면서 팝업 창이 나왔을 때 수직방향 스크롤바를 제거

    }else{
        $("body").removeClass("overflow");
    }


    $("#dark, #popup .close").click(function(){
        $("#dark").removeClass("active");
        $("#popup").removeClass("active");
        $("body").removeClass("overflow");
    });


});




function setCookie(name, value, expirehours){
    var todayDate = new Date();
    todayDate.setHours(todayDate.getHours() + expirehours); //현재 시간으로부터 expirehours(24) 더한 값으로 세팅

    console.log(todayDate);  //현재 시각이 10시라면 +2라는 만료일을 추가한 값인 12시로 표기

    console.log(document.cookie);



    document.cookie = name + "=" + escape(value) + "; path=/; expires=" + todayDate.toGMTString() + ";";

    console.log(document.cookie);
    console.log(todayDate.toGMTString());

    //문서의 쿠키를 설정하는 과정에서 key(name)와 16진수에 의한 쿠키 설정 value값과 동일하고 경로설정이 현재 위치이며, 설정제한시간이 쿠키의 설정 제한 시간과 동일한 값으로 구성

    //escape() 내장함수는 알파벳과 숫자 및 ( *, @, -, _, +, ., / )를 제외한 문자를 모두 16진수로 바꾸어준다. 쉼표와 세미콜론과 같은 문자가 쿠키열에서 충돌하는 것을 방지
    //콤마의 용도 : 객체를 구분시키는 용도
    //세미콜론의 용도 : 문장의 종료를 의미

    //toGMTString() : 표준시(GMT)를 사용하여 문자열로 변환된 일자를 반환(영국시간)
}




//"하루동안 열리지 않기" 버튼 클릭시
function todayClosePop(){
    //쿠키 설정 : setCookie(쿠키 설정 key, 쿠키 설정 value, 쿠키 설정 시간)
    setCookie("ncookie_24h", "done_24h", 24); //함수 호출문 + 매개변수에 전달될 데이터들
    document.getElementById("dark").setAttribute("class", "");  //비활성화 -> 기존 active라는 클래스명을 제거
    document.getElementById("popup").setAttribute("class", "");
    document.querySelector("body").classList.remove("overflow");
}




//화면이 열리면서 브라우저 내의 쿠키 상태를 체크
cookiedata = document.cookie;
console.log(cookiedata); //PHPSESSID=d2v40540nb2ak13conghpmeo3g

if(cookiedata.indexOf("ncookie_24h=done_24h")<0){  //"하루동안 열리지 않기" 버튼을 클릭하기 전 상태
    document.getElementById("dark").setAttribute("class", "active");
    document.getElementById("popup").setAttribute("class", "active");
    document.querySelector("body").classList.add("overflow");
}else{  //"하루동안 열리지 않기" 버튼을 클릭한 상태
    document.getElementById("dark").setAttribute("class", "");
    document.getElementById("popup").setAttribute("class", "");
    document.querySelector("body").classList.remove("overflow");
}




//스크립트의 실행순서
        //1)html 문서 내부에 존재하는 스크립트
        //2)외부 스크립트 문서에 존재하는 자바스크립트 (호출문과 함께 연동된 함수파트 포함)
        //3)외부 스크립트 문서에 존재하는 제이쿼리( $(document).ready(function(){}) )