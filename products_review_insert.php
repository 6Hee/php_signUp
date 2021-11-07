
<?php
    //http://localhost/oclass/products_review_insert.php?num=13
    $num = $_GET["num"];  //8 : products의 테이블에 등록된 프로그램의 고유 넘버


    session_start();
    if(isset($_SESSION["userid"])){
        $userid = $_SESSION["userid"];
    }else{
        $userid = "";
    }
    if(isset($_SESSION["username"])){
        $username = $_SESSION["username"];
    }else{
        $username = "";
    }
    if(isset($_SESSION["userpoint"])){
        $userpoint = $_SESSION["userpoint"];
    }else{
        $userpoint = "";
    }

    $score = $_POST["star_score"];
    $content = str_replace("'", "&#39;", $_POST["content"]);
    $regist_day = date("Y-m-d");


    include "./db_con.php";
    //만약 기존 리뷰가 존재한다면 1회만 작성하게 한다. (추후 결제 시스템까지 도입한다면 결제 관련 항목의 횟수에 관련하여 복수의 리뷰를 작성하게 한다.)
    $sql = "select * from review where pd_num='$num' and id='$userid'";
    $result = mysqli_query($con, $sql);
    $total_record = mysqli_num_rows($result);
    if($total_record){
        echo ("
            <script>
                alert('기존에 작성된 리뷰가 존재합니다. 작성해 주신 점 감사합니다.');
                history.go(-1);
            </script>
        ");
    }else{
        //리뷰를 등록하면 개인 포인트 5점씩 추가
        $new_point = $userpoint + 5;
        $sql = "update members set point='$new_point' where id='$userid'";
        mysqli_query($con, $sql);

        //session_start();  //session open에 대한 중복 에러발생
        $_SESSION["userpoint"] = $new_point; //5점이 추가된 포인트를 기존 세션의 userpoint라는 key의 새로운 값으로 갱신

        //review DB에 등록한다.
        $sql = "insert into review (id, name, pd_num, score, content, regist_day) ";
        $sql .= "values('$userid', '$username', '$num', '$score', '$content', '$regist_day')";
        mysqli_query($con, $sql);
        mysqli_close($con);

        echo ("
            <script>
                location.href = './products_view.php?num=$num';
            </script>
        ");
    }




?>