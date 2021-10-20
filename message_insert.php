<?php
    //http://localhost/oclass/message_insert.php?send_id=abc

    $send_id = $_GET["send_id"];
    $rv_id = $_POST["rv_id"];
    $subject = str_replace("'", "&#39;", $_POST["subject"]);
    $content = str_replace("'", "&#39;", $_POST["content"]);

    $regist_day = date("Y-m-d (H:i)");


    /*
    var_dump($send_id);
    var_dump($rv_id);
    var_dump($subject);
    var_dump($content);
    var_dump($regist_day);
    */


    include "./db_con.php";


    //#1. members 테이블로 접근하여 받는 사람(아이디)이 현재 회원으로 등록되어 있는가를 확인이 필요
    $sql = "select * from members where id='$rv_id'";
    $result = mysqli_query($con, $sql);  //object화된 데이터들을 모두 가져온다.
    $num_record = mysqli_num_rows($result);
    //var_dump($num_record);
    //$num_record = 1 이면, 받는 사람의 아이디가 존재하는 경우(true)
    //$num_record = 0 이면, 받는 사람의 아이디가 존재하지 않은 경우(false)



    if($num_record){  //받는 사람의 아이디가 존재할 경우
        $sql_m = "insert into message (send_id, rv_id, subject, content, regist_day)";
        $sql_m .= "values('$send_id', '$rv_id', '$subject', '$content', '$regist_day')";
        //var_dump($sql_m);

        //'$content' => '심청전 '아버지가 앞을 못봐서~''
        //작은 따옴표가 들어간 문자 내용 str_replace("'", "&#39;", $_POST["subject"]);
        //html 특수문자코드로 변환

        mysqli_query($con, $sql_m);


    }else{  //받는 사람의 아이디가 존재하지 않을 경우
        echo ("
            <script>
                alert('현재 입력한 회원은 존재하지 않습니다. 확인 후 재입력 바랍니다.');
                history.go(-1);
            </script>
        ");
    }

    mysqli_close($con);  //접속 종료


    echo ("
        <script>
            location.href='./message_box.php?mode=send';
        </script>
    ");





?>