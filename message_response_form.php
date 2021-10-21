<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OClass - 메시지 답장 보내기</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/message.css">
</head>
<body>
    <header>
        <?php include "./header.php"?>
    </header>
    <!--$userid, $username, $userlevel, $userpoint 값들 존재-->

<?php
    //로그인이 안된 상태로 접근을 했다면
    if(!$userid){
        echo ("
            <script>
                alert('로그인 후 이용 바랍니다.');
                location.href='./login_form.php?spot=message';
            </script>
        ");
    }
?>


    <section>
        <div class="subpage">
            <div class="frame">
                <div class="banner_title">
                    <h3>100% <span>Online Course</span></h3>
                    <h1>Get Future's Skill Today!</h1>
                </div>
            </div>
        </div>

        <div id="message_box">
            <h2>메시지 답장 보내기</h2>
<?php
            //http://localhost/oclass/message_response_form.php?num=21
            $num = $_GET["num"];
            //var_dump($num);  //21

            include "./db_con.php";
            $sql = "select * from message where num='$num'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($result);
            //var_dump($row);
            $send_id = $row["send_id"];
            $rv_id = $row["rv_id"];
            $subject = $row["subject"];
            $content = $row["content"];
            $regist_day = $row["regist_day"];

            //답글 제목의 좌측에 "RE: " 표기
            //내용 "------Original Message-------"를 표기
            $subject = "RE: ".$subject;   //RE: 메세지 제목
            $content = "\n\n\n ------Original Message------- \n".$content;
            //$content = str_replace("\n", "<br>", $content);


            //상대방의 이름을 가져오기(from members)
            $result2 = mysqli_query($con, "select name from members where id='$send_id'");
            $record = mysqli_fetch_array($result2);
            $send_name = $record["name"];
            var_dump($send_name); //상대방의 이름
?>            

            <ul class="top_buttons">
                <li><a href="./message_box.php?mode=rv">받은 메시지</a></li>
                <li><a href="./message_box.php?mode=send">보낸 메시지</a></li>
            </ul>



            <form name="message_form" action="./message_insert.php?send_id=<?=$userid?>" method="post">

                <div id="write_msg">
                    <ul>

                        <li>
                            <div class="label_box">
                                <label for="id">보내는 사람</label>
                            </div>
                            <div class="input_box">
                                <p><?=$userid?></p>
                            </div>
                        </li>

                        <li>
                            <div class="label_box">
                                <label for="rv_id1">받는 사람(아이디)</label>
                            </div>
                            <div class="input_box">
                                <p><?=$send_name?> (<?=$send_id?>)</p>
                                <input type="hidden" name="rv_id" id="rv_id1" value="<?=$send_id?>">
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
                                <textarea name="content" id="content1"><?=$content?></textarea>
                            </div>
                        </li>

                    </ul>


                    <button type="button" class="send_btn" onclick="check_input();">답장 보내기</button>
                    
                </div>
            </form>
        </div>
    </section>





    <footer>
        <?php include "./footer.php"?>
    </footer>



    <script src="./js/message.js"></script>    
</body>
</html>