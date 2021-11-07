<?php
    //cart_insert.php?num="+$rel+"&userid="+$dataUserId+"&pdEA="+$pd_ea

    if(isset($_GET["num"])){
        $pd_num = $_GET["num"];
    }else{
        $pd_num = "";
    }
    if(isset($_GET["userid"])){
        $userid = $_GET["userid"];
    }else{
        $userid = "";
    }
    if(isset($_GET["pdEA"])){
        $pd_ea = $_GET["pdEA"];
    }else{
        $pd_ea = "";
    }

    if($userid){
        include "./db_con.php";

        //products 테이블로부터 필요한 데이터만 가져온다. (by $pd_num)
        $sql = "select * from products where num='$pd_num'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);

        $pd_title = $row["title"];
        $pd_sub = $row["sub"];
        $pd_img = $row["file_copied"];
        $pd_price = $row["price"];

        //개별 상품 총 금액
        $pd_total_price = $pd_price * $pd_ea;

        //등록 날짜
        $regist_day = date("Y-m-d (H:i)");


        //동일한 상품이 로그인한 사람을 기준으로 존재하는지에 대한 여부 파악
        $sql = "select * from cart where id='$userid' and num='$pd_num'";  //아이디, 상품번호
        $result = mysqli_query($con, $sql);
        $cur_cart = mysqli_num_rows($result); //0이라면 해당 상품은 카트에 없음 //1이라면 해당 상품은 카트에 있음

        if($cur_cart){ //해당 상품은 카트에 있음
            //현재 카트에 담긴 수량을 가져와서 저장
            $sql = "select * from cart where id='$userid'";  //로그인한 사람이 장바구니에 담은 수량
            $result = mysqli_query($con, $sql);
            $total_record = mysqli_num_rows($result);

            $new_cart = $total_record;

            $inCart = "카트에 있음";
        }else{ //해당 상품은 카트에 없음


            //cart 테이블에 데이터 넣기
            $sql = "insert into cart (id, pd_num, pd_title, pd_sub, pd_img, pd_ea, pd_price, pd_total_price, regist_day)";
            $sql .= "values('$userid', '$pd_num', '$pd_title', '$pd_sub', '$pd_img', '$pd_ea', '$pd_price', '$pd_total_price', '$regist_day')";
    
            mysqli_query($con, $sql);

            $sql = "select * from cart where id='$userid'";  //로그인한 사람이 장바구니에 담은 수량
            $result = mysqli_query($con, $sql);
            $total_record = mysqli_num_rows($result);

            $new_cart = $total_record; //기존의 카트에 담긴 수량에서 한개가 추가된 상태의 수를 저장한다.

            $inCart = "카트에 없음";
        }



    }


    $json_list_arr = [$inCart, $new_cart];
    echo json_encode($json_list_arr);
    


    //동일한 상품을 동일한 사용자가 복수로 카트에 넣는 것을 막음
?>