<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OClass - 게시판 리스트</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/board.css">
</head>
<body>
    <header>
        <?php include "./header.php"?>
    </header>

    <section>
        <div class="subpage">
            <div class="frame">
                <div class="banner_title">
                    <h3>100% <span>Online Course</span></h3>
                    <h1>Get Future's Skill Today!</h1>
                </div>
            </div>
        </div>

        <div id="board_box">
            <h2 id="board_title">게시판 > 리스트</h2>
            <ul id="board_list">
                <li>
                    <span class="field_1">번호</span>
                    <span class="field_2">제목</span>
                    <span class="field_3">작성자</span>
                    <span class="field_4">첨부</span>
                    <span class="field_5">작성일</span>
                    <span class="field_6">조회수</span>
                </li>



<?php
    include "./db_con.php";

?>


                <!--공지 게시글-->

                <!--
                <li class="notice">
                    <span class="field_1">[공지]</span>
                    <span class="field_2">제목</span>
                    <span class="field_3">홍길동</span>
                    <span class="field_4"><img src="./img/clipL.gif" alt=""></span>
                    <span class="field_5">작성일</span>
                    <span class="field_6">조회수</span>
                </li>
                -->




                <!--일반 게시글-->
<?php
                if(isset($_GET["page"])){
                    //http://localhost/oclass/board_list.php?page=2
                    $page = $_GET["page"];
                }else{
                    //http://localhost/oclass/board_list.php
                    $page = 1;
                }





                $sql = "select * from board order by num desc"; //num의 항목을 기준으로 반대 방향으로 선택하겠다는 의미
                $result = mysqli_query($con, $sql);
                $total_record = mysqli_num_rows($result); //전체 데이터의 개수
                //var_dump($total_record);

                $scale = 10; //각 페이지별로 10개의 게시글을 보여주겠다.




                if($total_record % $scale == 0){  
                    $total_page = $total_record / $scale;
                }else{
                    $total_page = ceil($total_record / $scale);
                }
                //floor() : 내림, ceil() : 올림, round() : 반올림





                //표시할 페이지의 첫번째 보여줄 리스트의 시작번호
                $start = ($page - 1) * $scale;
                //1번 페이지일 경우, (1-1)*10 = 0(~9)
                //2번 페이지일 경우, (2-1)*10 = 10(~19)
                //3번 페이지일 경우, (3-1)*10 = 20(~29)





                //게시글리스트에서 번호란에 부여할 숫자를 구성
                $number = $total_record - $start;
                //만약 게시글이 101개 존재한다면
                //1번 페이지에서 첫번째 라인에 들어갈 번호는 101 - 0 = 101
                //2번 페이지에서 첫번째 라인에 들어갈 번호는 101 - 10 = 91
                //3번 페이지에서 첫번째 라인에 들어갈 번호는 101 - 20 = 81




                
                for($i = $start; $i < $start + $scale && $i < $total_record; $i++){
                    mysqli_data_seek($result, $i); //가져올 각각의 위치($i : 인덱스 번호)로 찾는 작업을 수행
                    $row = mysqli_fetch_array($result);
                    //var_dump($row);
                    $num = $row["num"];
                    $id = $row["id"];
                    $name = $row["name"];
                    $subject = $row["subject"];
                    $regist_day = $row["regist_day"];
                    $hit = $row["hit"];
                    if($row["file_name"]){  //DB에 첨부파일이 존재한다면, 첨부파일 이미지를 보여준다.
                        $file_name = "<img src='./img/clip.gif'>";
                    }else{   //DB에 첨부파일이 존재하지 않다면, 첨부파일 이미지를 보여주지 않는다.
                        $file_name = "";
                    }
                
?>
                <li>
                    <span class="field_1"><?=$number?></span>
                    <span class="field_2"><a href="./board_view.php?num=<?=$num?>&page=<?=$page?>"><?=$subject?></a></span>
                    <span class="field_3"><?=$name?></span>
                    <span class="field_4"><?=$file_name?></span>
                    <span class="field_5"><?=$regist_day?></span>
                    <span class="field_6"><?=$hit?></span>
                </li>
<?php
                    $number--;
                }
                mysqli_close($con);

?>

            </ul>
            <ul id="page_num">
<?php
                if($total_page >= 2 && $page >= 2){
                    //모든 전체 페이지의 개수가 2페이지 이상이고, 현재 페이지가 2번 페이지 이상일 때
                    $new_page = $page -1;
                    echo "<li><a href='./board_list.php?page=$new_page'>◀ 이전</a></li>";
                }
                for($i = 1; $i <= $total_page; $i++){
                    if($page == $i){
                        //현재 페이지는 반복하는 과정에서 접근한 숫자와 동일하다면 (현재 사용자가 보고 있는 화면의 페이지 번호가 맞다면)
                        echo "<li><span class='cur_page'>$i</span></li>";
                    }else{
                        echo "<li><a href='./board_list.php?page=$i'>$i</a></li>";
                    }
                }
                if($total_page >= 2 && $page != $total_page){
                    $new_page = $page + 1;
                    echo "<li><a href='./board_list.php?page=$new_page'>다음 ▶</a></li>";
                }
?>

            </ul>

<?php
    if($userid){
        //사용자가 로그인 후 세션에 $userid가 등록되었다면
?>
            <ul class="buttons">
                <li><button type="button" onclick="location.href='./board_form.php'">작성하기</button></li>
            </ul>
<?php
    }
?>
        </div>
    </section>


    <footer>
        <?php include "./footer.php"?>
    </footer>
        

    <script src="./js/board.js"></script>

</body>
</html>