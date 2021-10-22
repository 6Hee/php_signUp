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

    if(isset($_GET["page"])){  //http://localhost/oclass/message_box.php?mode=send$page=2
        $page = $_GET["page"];  //#1. 하단의 페이지 번호를 클릭했을 때
    }else{  //http://localhost/oclass/message_box.php?mode=send
        $page = 1;  //맨처음 보낸 메세지 또는 받은 메세지라는 버튼을 클릭시 첫번째 페이지를 가리킴
    }

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

    //var_dump($total_page);

    //첫번째 페이지($page)에서 100개의 데이터가 존재한다면
    //0번 데이터로부터 9번 데이터까지 가져오면 된다.
    $start = ($page - 1) * $scale;  //$scale = 10이라는 가정하에 진행
    //1번 페이지일 경우, (1 - 1) * 10 = 0 ~
    //2번 페이지일 경우, (2 - 1) * 10 = 10 ~
    //3번 페이지일 경우, (3 - 1) * 10 = 20 ~
    //n번 페이지일 경우, (n - 1) * 10 = 
    //$start 각 페이지별로 메세지리스트의 시작(데이터의 인덱스번호)을 의미



    

    //총 11개 였던 메시지가 2번째 페이지의 첫번째 리스트의 상세 보기에서 삭제 -> 삭제 처리 후 리스트로 돌아오는 과정에서 2번째 돌아왔더니 빈 리스트 페이지만 존재한다. -> 리스트 항목들이 존재하는 1번 페이지로 돌려 놓는다. 
    /*
    마지막 메시지를 삭제한 상태
    - $total_record (현재 메시지의 전체 개수를 알고 있음)
    - 두 번째 페이지로 열어라~~~ page=$page(2)  ==>  아무 리스트도 없는 상태
    - 아무것도 없는 상태인데 2번 페이지가 열렸는데 중간에 없다는 것을 제어하는 부분이 존재 => for문에서 반복을 진행하지 않았다는 것을 알 수 있음
    $start == $total_record
    2번째 페이지인데, $start = 10, $total_record = 10
    for($i = $start; $i < $start + $scale && $i < $total_record; $i++)
    => for($i = 10; $i < 10 + 10 && $i < 10; $i++)
    */


    //상세 페이지 삭제 후 해당하는 리스트에 항목이 존재하지 않을 경우
    if($start == $total_record){
        $new_page = $page - 1;
        echo ("
            <script>
                location.href='./message_box.php?mode=$mode&page=$new_page';
            </script>
        ");
    }






    $number = $total_record - $start;
    //만약 데이터 행의 개수가 100개라면
    //1번 페이지에서 100 - 0 = 100 ~ 91
    //2번 페이지에서 100 - 10 = 90 ~ 81
    //3번 페이지에서 100 - 20 = 80 ~ 71

    //만약 100개의 데이터가 존재하여 가져온 상태라면
    //1번 페이지일 경우, for($i = 0; $i < 0 + 10 &&  $i < 100; $i++) : $i = 0 ~ 9
    //2번 페이지일 경우, for($i = 10; $i < 10 + 10 &&  $i < 100; $i++) : $i = 10 ~ 19
    //3번 페이지일 경우, for($i = 20; $i < 20 + 10 &&  $i < 100; $i++) : $i = 20 ~ 29
    //...
    //10번 페이지일 경우, for($i = 90; $i < 90 + 10 &&  $i < 100; $i++) : $i = 90 ~ 99


    //만약 101개의 데이터가 존재하여 가져온 상태라면
    //1번 페이지일 경우, for($i = 0; $i < 0 + 10 &&  $i < 101; $i++) : $i = 0 ~ 9
    //...
    //10번 페이지일 경우, for($i = 90; $i < 90 + 10 &&  $i < 101; $i++) : $i = 90 ~ 99
    //11번 페이지일 경우, for($i = 100; $i < 100 + 10 &&  $i < 101; $i++) : $i = 100(종료)

    for($i = $start; $i < $start + $scale && $i < $total_record; $i++){
        mysqli_data_seek($result, $i); //mysqli_data_seek(최종 데이터 값들, 레코딩 순번:작성된 순서의 행을 가리킴) : 다량의 데이터(행 데이터)에서 순번(인덱스번호)을 찾아서 각각 메모리 값을 구성시킴
        $row = mysqli_fetch_array($result);
        //var_dump($row);

        $num = $row["num"];
        $subject = $row["subject"];

        if($mode == "send"){
            //보낸 메세지 리스트에서는 받은 사람이 필요
            $msg_id = $row["rv_id"];
        }else{ //받은 메세지 리스트에서는 보낸 사람이 필요
            $msg_id = $row["send_id"];
        }
        $regist_day = $row["regist_day"];


?>
                <li>
                    <span class="field_1"><?=$number?></span>
                    <span class="field_2"><a href="./message_view.php?mode=<?=$mode?>&num=<?=$num?>&page=<?=$page?>"><?=$subject?></a></span>
                    <span class="field_3"><?=$msg_id?></span>
                    <span class="field_4"><?=$regist_day?></span>
                </li>
<?php
        $number--;
    }
?>

            </ul>
            
            <ul id="page_num">
<?php
                //이전 페이지 이동 파트
                //현재 페이지가 1번 페이지일 경우, 이전 버튼은 보이지 않도록 구성 ==> 이전 버튼이 보일 수 있는 조건은 2번 페이지로 진입했을 때

                if($total_page >= 2 && $page >= 2){ //현재 모든 게시물을 담을 페이지 번호가 2 이상이고, 현재 페이지가 2번 페이지 이상일 경우
                    $new_page = $page - 1;
                    echo "<li><a href='./message_box.php?mode=$mode&page=$new_page'>◀ 이전</a></li>";
                }
                //<li><a href="">◀ 이전</a></li>

                //각 메세지 리스트 넘버 부여
                for($i = 1; $i <= $total_page; $i++){
                    if($page == $i){  //내가 선택한 페이지와 화면에 보여지는 페이지에 대한 일치여부를 확인 
                        echo "<li><span class='cur_page'>$i</span></li>";
                    }else{
                        echo "<li><a href='./message_box.php?mode=$mode&page=$i'>$i</a></li>";
                    }
                }

                //<li><a href="">1</a></li>
                //<li><a href="">2</a></li>

                //다음 페이지 이동 파트
                //만약 현재 페이지가 마지막 페이지를 보여주고 있고, 전체 페이지 개수가 현재 마지막 페이지를 보여주고 있지 않다면 다음이라는 버튼은 존재할 필요가 없음
                //#1. 모든 페이지 개수가 1이 아니라면
                //#2. 현재 페이지가 마지막 페이지가 아니라면
                if($total_page >= 2 && $page != $total_page){
                    $new_page = $page + 1;
                    echo "<li><a href='./message_box.php?mode=$mode&page=$new_page'>다음 ▶</a></li>";
                }

                //<li><a href="">다음 ▶</a></li>

?>
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
                <li>
                    <button type="button" onclick="location.href='./message_form.php'">메세지 보내기</button>
                </li>
            </ul>
        </div>


    </div>

    <footer>
        <?php include "./footer.php" ?>
    </footer>

</body>
</html>