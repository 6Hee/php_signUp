<?php


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


    $subject = $_POST["subject"];
    $content = $_POST["content"];
    $regist_day = date("Y-m-d (H:i)");

    /*
    var_dump($userid);
    var_dump($username);
    var_dump($subject);
    var_dump($content);
    */
    
    include "./db_con.php";
    $sql = "insert into faq (id, name, subject, content, regist_day)";
    $sql .= "values('$userid', '$username', '$subject', '$content', '$regist_day')";

    mysqli_query($con, $sql);

    mysqli_close($con);
    
    
    echo ("
        <script>

            location.href='./faq_list.php';
        </script>
        
    ");
    



?>