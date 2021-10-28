<?php
    //products_fav.php?num='+$rel+'&userid'+$dataUserId

    $pd_num = $_GET["num"]; // 11
    $userid = $_GET["userid"]; // admin

    include "./db_con.php";
    $sql = "select * from fav where id='$userid' and pd_num='$pd_num'";
    $result = mysqli_query($con, $sql);
    $cur_fav = mysqli_num_rows($result);  //DB에 존재한다면 1 / 존재하지 않다면 0

    if($cur_fav){  //이전에 특정 프로그램에 대하여 좋아요가 되어 있는 상태
        $sql = "delete from fav where id='$userid' and pd_num='$pd_num'";
        mysqli_query($con, $sql);  //♥ 클릭시 DB의 fav 테이블에서 삭제를 진행

        $sql = "select fav from products where num='$pd_num'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
        $fav = $row["fav"];

        $new_fav = $fav - 1;
        $sql = "update products set fav='$new_fav' where num='$pd_num'";
        mysqli_query($con, $sql);
        
        $faved = "좋아요 해제";

    }else{  //특정 프로그램에 좋아요를 최초로 클릭한 상태
        $sql = "insert into fav (id, pd_num, fav) values ('$userid', '$pd_num', '1')";
        mysqli_query($con, $sql);
        //fav라는 테이블에 신규 좋아요를 클릭한 데이터 정보를 저장함

        $sql = "select fav from products where num='$pd_num'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
        $fav = $row["fav"];
        //기존의 products 테이블의 fav 전체 횟수를 가져온다.

        $new_fav = $fav + 1;  //기존 fav 값에서 내가 클릭한 횟수인 1을 추가한다.
        $sql = "update products set fav='$new_fav' where num='$pd_num'";
        mysqli_query($con, $sql); //products 테이블의 fav의 값이 1 증가된다.

        $faved = "좋아요 선택";


    }





    
    $json_list_arr = [$faved, $new_fav];
    echo json_encode($json_list_arr);
    
    //echo => document.write()
    //현재 문서에 표시된 문자 장치를 작성하겠다는 의미
    //echo $faved;
    //ajax를 통해서 요청된 파일인 products_fav.php로 부터 응답받을 내용은 결국 문자형
?>

