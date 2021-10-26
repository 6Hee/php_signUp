<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OClass - 게시판 상세보기</title>
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
            <h2 id="board_title">게시판 > 상세 페이지</h2>
<?php
    //https://movie.naver.com/movie/bi/mi/basic.naver?code=191545
    //http://localhost/oclass/board_view.php?num=2&page=2
    $num = $_GET["num"];  //2
    $page = $_GET["page"];  //2
    // var_dump($num);
    // var_dump($page);

    include "./db_con.php";
    $sql = "select * from board where num='$num'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    //var_dump($row);
    $id = $row["id"];
    $name = $row["name"];
    $subject = $row["subject"];
    $content = $row["content"];
    $regist_day = $row["regist_day"];
    $hit = $row["hit"];  //본 해당하는 페이지를 여는 순간 조회수가 기존값에서 1씩 증가시킨다. -> DB로 접근하여 update과정을 거친다.
    $file_name = $row["file_name"];
    $file_type = $row["file_type"];
    $file_copied = $row["file_copied"];
    $notice = $row["notice"];
    if($notice == "1"){  //공지사항으로 등록된 항목이라면
        $final_subject = "[공지]".$subject;
    }else{  //공지사항으로 등록된 항목이 아니라면
        $final_subject = $subject;
    }


    $new_hit = $hit + 1; //기존 조회수(hit)에서 1을 추가한다.
    $sql1 = "update board set hit=$new_hit where num=$num";
    mysqli_query($con, $sql1);

?>
            <ul id="view_content">
                <li>
                    <span><b>제목 : </b> <?=$final_subject?></span>
                    <span><?=$name?> / <?=$regist_day?></span>
                </li>
                <li>
<?php
                    if($file_name){
                        $real_name = $file_copied;  //DB에 저장된 진짜이름(업로드한 원본 파일과는 다른 이름)

                        $file_path = "./data/".$real_name;  // http://localhost/oclass/data/2021_10_22_15_57_37.jpg(파일의 위치를 원본 URL(.../oclass/)로부터 상대경로를 설정)
                        //var_dump($file_path);

                        $file_size = filesize($file_path);  //filesize(경로 및 파일이름) : 저장된 파일의 크기를 가져오는 내장함수
                        //var_dump($file_size);  //int(205934) byte
                        echo "<div><img src='./img/clip.gif'> $file_name ($file_size Byte)<a href='./board_download.php?num=$num&real_name=$real_name&file_name=$file_name&file_type=$file_type'>첨부파일 다운로드</a></div>";
                    }
?>
                    <p><?=$content?></p>                   
                </li>
            </ul>

            <ul class="buttons">
                <li><button type="button" onclick="location.href='./board_list.php?page=<?=$page?>'">목록</button></li>
<?php
                /*
                [입장 권한]
                    비로그인 사용자 - 수정, 삭제, 작성하기 권한없음
                    로그인 사용자(Session['userid']의 값이 존재) - 작성하기 권한 부여
                    로그인 사용자(Session['userid']의 값이 존재) == $id - 수정, 삭제, 작성하기 권한 모두 존재
                */

                if($userid == $id){  //로그인한 사람과 게시글을 작성한 사람의 아이디가 서로 동일하다면
?>                
                <li><button type="button" onclick="location.href='./board_modify_form.php?num=<?=$num?>&page=<?=$page?>'">수정</button></li>
                <li><button type="button" onclick="location.href='./board_delete.php?num=<?=$num?>&page=<?=$page?>'">삭제</button></li>
<?php
                }
                if($userid){  //로그인만 한 사람이며, 작성자가 될 수도 있고 아닐 수도 있음
?>                
                <li><button type="button" onclick="location.href='./board_form.php'">작성하기</button></li>
<?php
                }
?>

            </ul>
        </div>
    </section>

    <footer>
        <?php include "./footer.php"?>
    </footer>
        

    <script src="./js/board.js"></script>
</body>
</html>
