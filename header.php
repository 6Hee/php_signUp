<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://kit.fontawesome.com/09743b710b.js" crossorigin="anonymous"></script>

<?php
    session_start();
    //isset($_SESSION['key값']) : 세션 항목에서 key값이라는 명칭이 등록되어 있다면 true(로그인인 된 상태) / 없다면 false(로그인이 아직 안된 상태)
    //var_dump(isset($_SESSION["userid"]));

    if(isset($_SESSION["userid"])){
        $userid = $_SESSION["userid"];
    }else{
        $userid = "";
    }

    if(isset($_SESSION["username"])){
        $username = $_SESSION["username"];
    }else{
        $username = "";
    }

    if(isset($_SESSION["userlevel"])){
        $userlevel = $_SESSION["userlevel"];
    }else{
        $userlevel = "";
    }

    if(isset($_SESSION["userpoint"])){
        $userpoint = $_SESSION["userpoint"];
    }else{
        $userpoint = "";
    }
/*
    var_dump($userid);
    var_dump($username);
    var_dump($userlevel);
    var_dump($userpoint);
*/
?>




<div id="top">
    <div class="frame">
        <div class="top_info">
            <p><i class="fas fa-phone-square"></i> Support: +82 322 4456</p>
        </div>
        <ul id="top_menu">

<?php
    //로그인 안 된 상태에서만 보여줄 메뉴(세션에 등록 없는 상태)
    if(!$userid){
?>

            <li><a href="./member_form.php">회원가입</a></li>
            <li><a href="./login_form.php">로그인</a></li>

<?php
    }else{
        $logged = $username."(".$userid.") 님[Lv : ".$userlevel."/ Pt : ".$userpoint."]";
?>
            <li><span><?=$logged?></span></li>
            <li><a href="./member_modify_form.php">정보수정</a></li>
            <li><a href="./logout.php">로그아웃</a></li>
<?php
    }
    //레벨 1인 경우만 관리자로 인식하여 웹 사이트 관리자 페이지로 입장 가능하도록 구성
    if($userlevel == 1){
?>
        <li><a href="./admin.php">관리자</a></li>
<?php
    }

?>


        </ul>
    </div>
</div>
<nav>
    <div class="frame">
        <div class="logo">
            <a href="./"><img src="./img/OClass_logo.svg" alt="로고"></a>
        </div>
        <div id="menu_bar">
            <ul>
                <li><a href="./message_form.php">메시지 보내기</a></li>
                <li><a href="./board_form.php">게시판</a></li>
            </ul>
        </div>
    </div>
</nav>