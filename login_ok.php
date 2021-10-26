<?php

    //http://localhost/oclass/login_form.php?spot=message
    if(isset($_GET["spot"])){
        $spot = $_GET["spot"];
    }else{
        $spot = "";
    }
    var_dump($spot);


    $id = $_POST["id"];
    $pass = $_POST["pass"];

    include "./db_con.php";

    $sql = "select * from members where id='$id'";

    //var_dump($sql);

    $result = mysqli_query($con, $sql);
    //var_dump($result);

    $num_match = mysqli_num_rows($result);
    //var_dump($num_match); //int(1) => 로그인 화면에서 입력된 아이디가 존재한다.
    //int(0) => 로그인 화면에서 입력된 아이디가 존재하지 않는다.


    if(!$num_match){
        //회원이 아닌 아이디를 입력
        echo ("
            <script>
                alert('등록되지 않은 아이디 입니다.');

                history.go(-1);
            </script>
        ");

    }else{
        //회원인 아이디 입력
        $row = mysqli_fetch_array($result);
        //var_dump($row);
        //여러가지 배열 데이터 중에서 pass에 담긴 항목만 가져온다.
        $db_pass = $row["pass"];
        //var_dump($db_pass); //입력한 아이디의 패스워드만 추출

        mysqli_close($con); //접속 종료


        if($pass != $db_pass){
            //로그인 페이지로부터 입력한 패스워드와 회원가입시 작성한 DB 내의 패스워드가 일치하지 않는다면 -> 로그인불가

            echo ("
                <script>
                    alert('입력한 비밀번호가 다릅니다.');

                    history.go(-1);
                </script>
            
            ");
            //경고창을 띄우고 나서 지금 현재 페이지로부터 이전 페이지로 이동 시켜라. => [url 창]
            //login_form.php로 변경되면서 로그인 화면이 다시 나온다.
            exit; //탈출(이후 문구는 로딩 안함) 함수문에서 비교 했을 때, return과 유사
        }else{
            //입력한 패스워드와 DB 내의 패스워드가 일치한다면

            session_start(); //세션 스토리지를 오픈해라
            //세션 스토리지에 배열 데이터로부터 받아온 결과값들을 각각의 key와 value 값으로 저장을 진행

            $_SESSION["userid"] = $row["id"];
            $_SESSION["username"] = $row["name"];
            $_SESSION["userlevel"] = $row["level"];
            $_SESSION["userpoint"] = $row["point"];

            //key1 : value1 ==> userid : USER의 실제 아이디 데이터
            //key2 : value2 ==> username : USER의 실제 이름 데이터
            //key3 : value3 ==> userlevel : USER의 실제 레벨 데이터
            //key4 : value4 ==> userpoint : USER의 실제 포인트 데이터



            //var_dump($_SESSION["username"]);

            if(!$spot){
                echo ("
                    <script>
                        location.href='./';
                    </script>
                ");
            }elseif($spot == "message"){
                echo ("
                    <script>
                        location.href='./message_form.php';
                    </script>
                ");
            }elseif($spot == "board"){
                echo ("
                    <script>
                        location.href='./board_form.php';
                    </script>
                ");
            }elseif($spot == "products"){
                echo ("
                    <script>
                        history.go(-1);
                        location.href='./products_form.php';
                    </script>
                ");
            }
/*
            echo ("
                <script>
                    location.href='./';
                </script>
            
            ");
*/
        }

    }

?>