<?php
    //http://localhost/oclass/member_modify.php?id=kjh8213


    //kjh8213 => 이 사람의 아이디명을 알고 있음(DB members 테이블에서 유일 존재)


    $id = $_GET["id"];
    $pass = $_POST["pass"];
    $name = $_POST["name"];
    $email1 = $_POST["email1"];
    $email2 = $_POST["email2"];
    $email = $email1."@".$email2;

    include "./db_con.php";


    $sql = "update members set pass='$pass', name='$name', email='$email' where id='$id'"; //현재 로그인한 유저를 대상(where 조건)으로 각 변경된 항목을 모두 변경하겠다는 의미

/*
    $sql = "update members set pass='$pass', name='$name', email='$email'";
    $sql .= "where id='$id'";
*/

    mysqli_query($con, $sql);
    //회원정보 수정에 의한 DB 수정이 진행

    //수정을 진행했음에도 불구하고, 기존 session['username']을 로그인했을 당시의 값을 저장된 상태이기 때문에, 세션의 재등록이 반드시 필요

    $sql2 = "select * from members where id='$id'";
    $result = mysqli_query($con, $sql2);
    $row = mysqli_fetch_array($result);

    //var_dump($row["name"]);

    //세션 재등록
    session_start();
    $_SESSION['username'] = $row["name"];
    $_SESSION['userlevel'] = $row["level"];
    $_SESSION['userpoint'] = $row["point"];

    mysqli_close($con);

    echo ("
        <script>
            location.href='./';
        </script>
    ");

?>