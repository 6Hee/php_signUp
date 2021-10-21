<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OClass - 메세지 상세보기</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/message.css">
</head>
<body>
    
    <header>
        <?php include "./header.php" ?>
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


        <div id="message_box">
<?php
            //http://localhost/oclass/message_view.php?mode=send&num=33
            $mode = $_GET["mode"]; //send 또는 rv
            $num = $_GET["num"]; //DB에서 등록된 num값을 가져온다.
            $page = $_GET["page"];  //상세 페이지로 들어오기 직전의 리스트 페이지의 페이지 번호를 알고 있음. 
            
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



            //답장의 콘텐츠 영역을 조작
            $content = str_replace("------Original Message-------", "<br><br><br>  ------Original Message-------<br>", $content); //작성된 상태로 줄바꿈을 구성한 후 위치에 넣는다. 내부의 <br>태그는 들어가는 과정에서 줄바꿈이 일어난다.




            if($mode == "send"){ //보낸 메시지로부터 접근한 상세 페이지 -> 받은 사람의 이름 필요(회원 중에 오직 하나밖에 없는 아이디로부터 추적하여 이름을 가져온다. - from members(테이블))
                $result2 = mysqli_query($con, "select name from members where id='$rv_id'");



            }else{  //받은 메시지로부터 접근한 상세 페이지 -> 보낸 사람의 이름 필요(회원 중에 오직 하나밖에 없는 아이디로부터 추적하여 이름을 가져온다. - from members(테이블))
                $result2 = mysqli_query($con, "select name from members where id='$send_id'");
            }

            //var_dump($result2);
            $record = mysqli_fetch_array($result2);
            //var_dump($record);

            $msg_name = $record["name"];

            if($mode == "send"){
                echo "<h2>보낸 메세지 > 상세보기</h2>";
            }else{
                echo "<h2>받은 메세지 > 상세보기</h2>";
            }

?>


            
            <ul id="message_view">
                <li><span>제목</span> : <?=$subject?></li>
                <li><span>
<?php
                    if($mode == "send"){
                        echo "받은 사람";
                    }else{
                        echo "보낸 사람";
                    }
?>
                </span> : <?=$msg_name?></li>


                <li><span>내용</span> : <?=$content?></li>
                <li><span>작성일</span> : <?=$regist_day?></li>
            </ul>
            <ul class="msg_link">
                <li>
                    <button type="button" onclick="location.href='./message_box.php?mode=rv'">받은 메세지</button>
                </li>
                <li>
                    <button type="button" onclick="location.href='./message_box.php?mode=send'">보낸 메세지</button>
                </li>

                <li>
                    <button type="button" onclick="location.href='./message_box.php?mode=<?=$mode?>&page=<?=$page?>'">목록보기</button>
                </li>
<?php
                if($mode != "send"){
                    //내가 보낸 메세지가 아닌 받은 메세지
?>
                <li>
                    <button type="button" onclick="location.href='./message_response_form.php?num=<?=$num?>'">답장 보내기</button>
                </li>
<?php
                }
?>
                <li>
                    <button type="button" onclick="location.href='./message_delete.php?mode=<?=$mode?>&num=<?=$num?>&page=<?=$page?>'">삭제</button>
                </li>
            </ul>
        </div>
    </section>



    <footer>
        <?php include "./footer.php" ?>
    </footer>


</body>
</html>