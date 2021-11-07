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
    if($userlevel == 1 && $userid == "admin"){
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
                <li><a href="./products_list.php">프로그램</a></li>

<?php
    include "./db_con.php";
    $sql = "select * from message where rv_id='$userid' and readed='0'"; //조건을 추가 읽음 / 안 읽음
    $result = mysqli_query($con, $sql);
    $total_record = mysqli_num_rows($result);
    if($total_record){ 
?>
                <li>
                    <a href="./message_box.php?mode=rv">받은 메세지
                        <span> - <?=$total_record?></span>
                    </a>
                </li>
<?php
    }else{
?>
                <li><a href="./message_form.php">메시지 보내기</a></li>
<?php
    }
?>
                <li><a href="./board_list.php">게시판</a></li>
                <li><a href="./faq_list.php">FAQ</a></li>
<?php
    if($userid){
?>
                <li>
                    <a href="./cart_list.php">CART
<?php
        //로그인 사용자의 카트에 하나라도 존재한다면
        $sql = "select * from cart where id='$userid'";
        $result = mysqli_query($con, $sql);
        $total_record = mysqli_num_rows($result);
        if($total_record){
?>
                        <span class="cur_cart"> - 
                            <span class="cart_num"><?=$total_record?></span>
                        </span>
<?php
        }
?>
                    </a>
                </li>
<?php
    }
?>
            </ul>
        </div>
    </div>
</nav>