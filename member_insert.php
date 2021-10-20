<?php
    /**member_inset.php**/
    //1차 관문(member_form.js) =submit()=> 2차 관문(member_inset.php)

    $id = $_POST["id"];
    $pass = $_POST["pass"];
    $name = $_POST["name"];
    $email1 = $_POST["email1"];
    $email2 = $_POST["email2"];
    $email = $email1."@".$email2;
    $regist_day = date("Y-m-d (H:i)");


    /*
    var_dump($id);
    var_dump($pass);
    var_dump($name);
    var_dump($email1);
    var_dump($email2);
    var_dump($email);
    var_dump($regist_day);
    */

    include "./db_con.php";  //$con(DB 접속 정보) + 인코딩 방법

    //기존 아이디가 존재하는 것을 찾는다.
    $sql = "select * from members where id='$id'";
    $result = mysqli_query($con, $sql);
    $num_record = mysqli_num_rows($result);  //int(1) => true //int(0) => false
    if($num_record){ //DB 내에 동일한 아이디가 존재한다 => 회원가입 화면으로 다시 돌려보낸다.
        echo ("
            <script>
                alert('동일한 아이디가 있습니다. 아이디를 변경해주세요.');
                //location.href='./member_form.php';
                history.go(-1);  //바로 직전 페이지로 돌아가겠다는 의미
            </script>
        ");
    }else{  //DB 내에 동일한 아이디가 존재하지 않다. => 회원가입을 진행
        $sql1 = "insert into members (id, pass, name, email, regist_day, level, point) values('$id', '$pass', '$name', '$email', '$regist_day', 9, 0)";
        mysqli_query($con, $sql1);
    }
    mysqli_close($con); //접속 종료

    //DB의 회원정보 members라는 데이블에 넣은 후 접속을 종료한 다음에 첫화면(메인)으로 이동을 시킨다.
    echo "
        <script>
            location.href='./'; 
        </script>
    ";
    //첫화면으로 URL 창으로 조작하여 화면을 전환 시킨다.


?>