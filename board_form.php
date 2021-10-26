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
            <h2 id="board_title">게시판 > 작성하기</h2>
            <!--
                [데이터를 전송하는 방식(method)에는 get 방식과 post 방식 + enctype 속성의 multipart/form-data]
                - get 방식은 URL 창에 폼의 데이터가 노출되는 방식. 입력 내용에 대한 길이 제한이 존재(256~4,096byte 데이터 전송 가능)  
                //메인 이미지(1920 * 1080) - 1pixel 당 최대 4byte를 가져간다는 계산 하에 2,073,600 * 4 = 8,294,400byte =~ 8MB
                
                -post방식은 URL 창에는 폼의 데이터가 노출되지 않은 방식. 입력 내용에 대한 길이 제한은 없음. 문제는 데이터를 한번에 보낼 수 없는 조건에는 한계가 존재. 이를 보완하고자 대용량의 파일을 전송할 때는 문제점(중간 유실)이 발생. 폼 태그 내부에 enctype="multipart/form-data"를 작성했다면 추가로 한번에 대용량 전송이 가능(첨부파일이 존재할 때 사용)
            -->

            <form name="board_form" action="./board_insert.php" method="post" enctype="multipart/form-data">
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
                            <input type="text" name="subject" id="subject1">
                        </div>
                    </li>
                    <li>
                        <div class="label_box">
                            <label for="content1">내용</label>
                        </div>
                        <div class="input_box">
                            <textarea name="content" id="content1" placeholder="700자 이내로 작성해 주세요."></textarea>
                        </div>
                    </li>
                    <li>
                        <div class="label_box">
                            <label for="upfile1">첨부파일</label>
                        </div>
                        <div class="input_box">
                            <input type="file" class="upload" name="upfile" id="upfile1">
                        </div>
                    </li>
                    <!--공지/일반 여부 추가-->
<?php
    if($userlevel == 1){
?>

                    <li>
                        <div class="label_box">
                            <label for="notice1">공지여부</label>
                        </div>
                        <div class="input_box">
                            <select name="notice" id="notice1">
                                <option value="0" selected>일반 게시글</option>


                                <option value="1">공지 게시글</option>
                            </select>
                        </div>
                    </li>

<?php
    }
?>
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