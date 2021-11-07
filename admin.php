<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>oclass - 관리자 페이지</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/admin.css">
</head>
<body>
    
    <header>
        <?php include "./header.php"?>
    </header>

<?php
    //만약 화면의 주소(admin.php)를 알고 있는 해커들이 입장 불가능 하도록 구성
    if($userid != "admin" && $userlevel > 1){
        echo("
            <script>
                alert('입장 가능한 관리자가 아닙니다.');
                location.href='./';
            </script>
        ");
    }

    include "./db_con.php";
    $sql = "select * from members where level not in('1') order by num desc"; //레벨 1인 사용자 제외
    $result = mysqli_query($con, $sql);
    $total_record = mysqli_num_rows($result);  //데이터 행의 개수
    $number = $total_record;  //전체 회원수
?>
    
    <section>
        <div id="admin_box">
            <h2>관리자 페이지(회원 관리)</h2>
            <ul id="member_list">
                <li>
                    <span class="field1">번호</span>
                    <span class="field2">아이디</span>
                    <span class="field3">이름</span>
                    <span class="field4">레벨</span>
                    <span class="field5">포인트</span>
                    <span class="field6">가입일</span>
                    <span class="field7">수정</span>
                    <span class="field8">삭제</span>
                </li>
<?php
    while($row = mysqli_fetch_array($result)){
        $num = $row["num"];
        $id = $row["id"];
        $name = $row["name"];
        $level = $row["level"];
        $point = $row["point"];
        $regist_day = $row["regist_day"];

?>
                <li>
                    <form name="member_list" action="./admin_member_modify.php?num=<?=$num?>" method="post">
                        <span class="field1"><?=$number?></span>
                        <span class="field2"><?=$id?></span>
                        <span class="field3"><?=$name?></span>
                        <span class="field4"><input type="number" name="level" value="<?=$level?>"></span>
                        <span class="field5"><input type="number" name="point" value="<?=$point?>"></span>
                        <span class="field6"><?=$regist_day?></span>
                        <span class="field7"><button type="submit">수정</button></span>
                        <span class="field8"><button type="button" onclick="location.href='./admin_member_delete.php?num=<?=$num?>'">삭제</button></span>
                    </form>
                </li>
<?php
        $number--;
    }
?>
            </ul>

            <h2>관리자 페이지 (게시글 관리)</h2>
            <form name="boardList" action="./admin_board_delete.php" method="post">
                <ul id="board_list">
                    <li>
                        <span class="field1">선택</span>
                        <span class="field2">번호</span>
                        <span class="field3">이름</span>
                        <span class="field4">제목</span>
                        <span class="field5">첨부파일</span>
                        <span class="field6">작성일</span>
                    </li>
<?php
    $sql = "select * from board order by num desc";
    $result = mysqli_query($con, $sql);
    $total_record = mysqli_num_rows($result);
    $number = $total_record;

    while($row = mysqli_fetch_array($result)){
        $num = $row["num"];
        $name = $row["name"];
        $subject = $row["subject"];
        $file_name = $row["file_name"];
        $regist_day = substr($row["regist_day"], 0, 10);
    
?>
                        <li>
                            <span class="field1"><input type="checkbox" name="unit[]" value="<?=$num?>"></span>
                            <span class="field2"><?=$number?></span>
                            <span class="field3"><?=$name?></span>
                            <span class="field4"><?=$subject?></span>
                            <span class="field5"><?=$file_name?></span>
                            <span class="field6"><?=$regist_day?></span>
                        </li>
<?php
        $number--;
    }
?>
                </ul>
                <button type="submit" class="sel_del">선택 항목 삭제</button>
            </form>


            <h2>관리자 페이지 (프로그램 관리)</h2>
            <form name="productList" action="./admin_product_delete.php" method="post">
                <ul id="product_list">
                    <li>
                        <span class="field1">선택</span>
                        <span class="field2">이미지</span>
                        <span class="field3">프로그램</span>
                        <span class="field4">프로그램 내용</span>
                        <span class="field5">좋아요 수</span>
                        <span class="field6">조회수</span>
                        <span class="field7">기본요금(원)</span>
                        <span class="field8">등록일</span>
                    </li>

<?php
    $sql = "select * from products order by num desc";
    $result = mysqli_query($con, $sql);
    $total_record = mysqli_num_rows($result);

    $number = $total_record;

    while($row = mysqli_fetch_array($result)){
        //num name title sub content price fav hit regist_day file_name file_type file_copied
        $num = $row["num"];
        $pd_img = "./products/".$row["file_copied"];
        $title = $row["title"];
        $content = $row["content"];
        $fav = $row["fav"];
        $hit = $row["hit"];
        $price = $row["price"];
        $regist_day = substr($row["regist_day"], 0, 8);
?>
                    <li>
                        <span class="field1"><input type="checkbox" name="unit[]" value="<?=$num?>"></span>
                        <span class="field2"><img src="<?=$pd_img?>" alt=""></span>
                        <span class="field3"><?=$title?></span>
                        <span class="field4"><?=$content?></span>
                        <span class="field5"><?=$fav?></span>
                        <span class="field6"><?=$hit?></span>
                        <span class="field7"><?=$price?></span>
                        <span class="field8"><?=$regist_day?></span>
                    </li>
<?php
        $number--;
    }
?>
                </ul>
                <button type="submit" class="sel_del">선택 항목 삭제</button>
            </form>


        </div>
    </section>


    <footer>
        <?php include "./footer.php"?>
    </footer>

</body>
</html>