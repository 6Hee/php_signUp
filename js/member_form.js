//**  member_form.js  **//

function check_input(){
    //아이디 작성여부 확인
    //form 태그로 전급을 하기 위해서는 각 요소들의 name 속성값으로 접근을 시킴(각 요소를 선택한 것과 동일)

    if(!document.member_form.id.value){
        //조건에 대한 해석 : "회원가입" 버튼 클릭시 아이디 입력상자에 입력값이 존재하지 않다면 
        alert("아이디를 입력하세요.");
        document.member_form.id.focus();
        //focus() : 접근시 먼저 초점이 발생할 수 있도록 포커싱한다.

        return; //return; 의 의미는 break; 와 동일(함수문에서 탈출)
    }

    //비밀번호 wkrtjdduqn
    if(!document.member_form.pass.value){
        alert("비밀번호를 입력하세요.");
        document.member_form.pass.focus();

        return;
    }
    //비밀번호 확인 작성여부
    if(!document.member_form.pass_confirm.value){
        alert("비밀번호 확인을 입력하세요.");
        document.member_form.pass_confirm.focus();

        return;
    }

    //이름 작성여부
    if(!document.member_form.name.value){
        alert("이름을 입력하세요.");
        document.member_form.name.focus();

        return;
    }

    //이메일 첫번째 작성여부
    if(!document.member_form.email1.value){
        alert("이메일을 입력하세요.");
        document.member_form.email1.focus();

        return;
    }

    //이메일 두번째 작성여부
    if(!document.member_form.email2.value){
        alert("이메일을 입력하세요.");
        document.member_form.email2.focus();

        return;
    }



    //비밀번호와 비밀번호 확인 입력값이 일치여부 확인
    if(document.member_form.pass.value != document.member_form.pass_confirm.value){
        alert("비밀번호와 비밀번호 확인의 입력값이 일치하지 않습니다.");
        
        //위의 두 입력상자 입력값을 지운다.
        document.member_form.pass.value = "";
        document.member_form.pass_confirm.value = "";
        
        document.member_form.pass.focus();

        return;
    }
    //위의 모든 조건에서 문제가 발생하지 않는다면, 전송(form 태그에서 action이라는 속성값은 지정된 URL로 접근을 시킴)
    document.member_form.submit();
}


//"취소하기"라는 버튼 클릭시, 입력상자의 모든 내용은 공란으로 처리하고 + 맨 처음 아이디 입력 상자에 포커싱을 맞춘다.

function reset_form(){
    document.member_form.id.value = "";
    document.member_form.pass.value = "";
    document.member_form.pass_confirm.value = "";
    document.member_form.email1.value = "";
    document.member_form.email2.value = "";
    document.member_form.name.value = "";
    document.member_form.id.focus();
}


function check_id(){

    if(!document.member_form.id.value){
        
        alert("아이디를 입력하세요.");
        document.member_form.id.focus();
        

        return;
    }
    window.open("./member_check_id.php?id="+document.member_form.id.value, "checkID", "width=400, height=300");
}