<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OClass - 게시판 작성</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/board.css">
</head>
<body>
    <header>
        <?php include "./header.php"?>
    </header>

    <!--unset SESSION : 로그아웃 된 상태-->

    <!--로그인 된 회원만 게시판 작성하기 허용-->
    <?php include "./board_log_chk.php"?>

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
            <h2>게시판 > 수정</h2>

<?php
    //http://localhost/oclass/board_modify_form.php?num=2&page=2
    $num = $_GET["num"];  //실제 DB에서 각 항목의 데이터들을 가져오는 역할을 담당
    $page = $_GET["page"];  //하단의 목록 보기라는 곳을 클릭했을 때 해당하는 리스트 페이지 번호로 진입시키기 위한 도구

    include "./db_con.php";

    $sql = "select * from board where num='$num'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    $name = $row["name"];
    $subject = $row["subject"];
    $content = $row["content"];
    $file_name = $row["file_name"];

    if($row["notice"] == "1"){  //공지 게시글
        $notice = "공지 게시글";
    }else{  //일반 게시글
        $notice = "일반 게시글";
    }
?>
            <form name="board_form" action="./board_modify.php?num=<?=$num?>&page=<?=$page?>" method="post" enctype="multipart/form-data">
                <ul id="board_form">
                    <li>
                        <div class="label_box">
                            <label for="username">작성자</label>
                        </div>
                        <div class="input_box">
                            <p><?=$userid?>(<?=$username?>)</p>
                        </div>
                    </li>
                    <li>
                        <div class="label_box">
                            <label for="subject1">제목</label>
                        </div>
                        <div class="input_box">
                            <input type="text" name="subject" id="subject1" value="<?=$subject?>">
                        </div>
                    </li>
                    <li>
                        <div class="label_box">
                            <label for="content1">내용</label>
                        </div>
                        <div class="input_box">
                            <textarea name="content" id="content1" placeholder="700자 이내로 작성해 주세요."><?=$content?></textarea>
                        </div>
                    </li>
                    <li>
                        <div class="label_box">
                            <label for="upfile1">첨부파일</label>
                        </div>
                        <div class="input_box">
                            <input type="file" class="upload" name="upfile" id="upfile1">
                            <p class="origin_file"><?=$file_name?></p>
                        </div>
                    </li>
                    <!--공지/일반 여부 추가-->
                    <li>
                        <div class="label_box">
                            <label for="notice1">공지여부</label>
                        </div>
                        <div class="input_box">
                            <select name="notice" id="notice1" state="<?=$notice?>">
                                <option value="0">일반 게시글</option>
                                <option value="1">공지 게시글</option>
                            </select>
                        </div>
                    </li>
                </ul>
                <ul class="buttons">
                    <li><button type="button" onclick="check_input();">작성 완료</button></li>
                    <li><button type="button" onclick="location.href='./board_list.php'">목록보기</button></li>
                </ul>
            </form>
        </div>
    </section>

    <footer>
        <?php include "./footer.php"?>
    </footer>

    <script src="./js/board.js"></script>
</body>
</html>