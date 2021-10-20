<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OClass - 메세지 리스트</title>
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
    </section>

    <div id="message_box">
<?php
    
    //http://localhost/oclass/message_box.php?mode=send
    $mode = $_GET["mode"];
    if($mode == "send"){
?>

        <h2>보낸 메세지 > 리스트</h2>

<?php
    }else{
?>

        <h2>받은 메세지 > 리스트</h2>
<?php
    }
?>

        <div id="message_list">
            <ul id="message">
                <li>
                    <span class="field_1">번호</span>
                    <span class="field_2">제목</span>
                    <span class="field_3">
<?php
    //보낸 메세지 리스트가 열린 상태라면 "받은 사람"
    //받은 메세지 리스트가 열린 상태라면 "보낸 사람"
                    
                    if($mode == "send"){
                        echo "받은 사람";
                    }else{
                        echo "보낸 사람";
                    }

?>
                    </span>
                    <span class="field_4">등록일</span>
                </li>

<?php
    //여러가지 항목의 데이터값을 넣을 수 있는 조건이 필요
    //데이터의 개수(행)를 기준으로 반복문을 적용하여 그 내부에 각각의 데이터값을 넣어줄 예정
    //세션에 저장된 인물의 아이디는 로그인을 하고 온 당사자(USER)
    //보낸 메세지 리스트에서 보낸 사람은 > 로그인한 유저 
    //받은 메세지 리스트에서 보낸 사람은 > 로그인한 유저
    
    
    include "./db_con.php";

    if($mode == "send"){
        //보낸 메세지에서 DB로 접근
        $sql = "select * from message where send_id='$userid' order by num desc";
    }else{
        //받은 메세지에서 DB로 접근
        $sql = "select * from message where rv_id='$userid' order by num desc";
    }


    $result = mysqli_query($con, $sql);
    $total_record = mysqli_num_rows($result);
    //var_dump($total_record);  //6



    $scale = 10; //한 페이지당 10개의 메세지 리스트만 보여줄 것이다. 변수에 저장

    //만약, $total_record = 20 라면, 하단부에 1,2으로 표기
    //만약, $total_record = 22 라면, 하단부에 1,2,3으로 표기

    if($total_record % $scale == 0){
        $total_page = $total_record / $scale; 

    }else{
        $total_page = ceil($total_record / $scale);

    }

    var_dump($total_page);



    for($i = 0; $i < $total_record; $i++){
        mysqli_data_seek($result, $i); //mysqli_data_seek(최종 데이터 값들, 레코딩 순번:작성된 순서의 행을 가리킴) : 다량의 데이터(행 데이터)에서 순번(인덱스번호)을 찾아서 각각 메모리 값을 구성시킴
        $row = mysqli_fetch_array($result);
        //var_dump($row);

        $num = $row["num"];
        $subject = $row["subject"];

        if($mode == "send"){
            //보낸 메세지 리스트
            $msg_id = $row["rv_id"];
        }else{
            $msg_id = $row["send_id"];
        }
        $regist_day = $row["regist_day"];


?>
                <li>
                    <span class="field_1"><?=$num?></span>
                    <span class="field_2"><?=$subject?></span>
                    <span class="field_3"><?=$msg_id?></span>
                    <span class="field_4"><?=$regist_day?></span>
                </li>
<?php
    }
?>

            </ul>
            
            <ul id="page_num">
<?php
                //이전 이동 파트
                //<li><a href="">◀ 이전</a></li>

                //각 메세지 리스트 넘버 부여
                //<li><a href="">1</a></li>
                //<li><a href="">2</a></li>

                //다음 페이지 이동 파트
                //<li><a href="">다음 ▶</a></li>

?>
            </ul>


            <ul class="msg_link">
                <li><button type="button" onclick="location.href='./message_box.php?mode=rv'">받은 메세지</button></li>
                <li><button type="button" onclick="location.href='./message_box.php?mode=send'">보낸 메세지</button></li>
                <li><button type="button" onclick="location.href='./message_form.php'">메세지 보내기</button></li>
            </ul>
        </div>


    </div>

    <footer>
        <?php include "./footer.php" ?>
    </footer>

</body>
</html>