<?php
    //http://localhost/oclass/message_delete.php?mode=rv&num=6&page=2
    $mode = $_GET["mode"];
    $num = $_GET["num"];
    $page = $_GET["page"];

    include "./db_con.php";

    $sql = "delete from message where num='$num'";
    mysqli_query($con, $sql);
    mysqli_close($con);
/*
    if($mode == "send"){ //[보낸 메세지 > 상세보기]에서 삭제를 진행했다면, 보낸 메세지 리스트로 이동을 시킴
        $target_url = "./message_box.php?mode=send&page=<?=$page?>";
    }else{  //[받은 메세지 > 상세보기]에서 삭제를 진행했다면, 받은 메세지 리스트로 이동을 시킴
        $target_url = "./message_box.php?mode=rv&page=<?=$page?>";
    }
*/
    $target_url = "./message_box.php?mode=$mode&page=$page";

    echo ("
        <script>
            location.href='$target_url';
        </script>
    ");

    //$target_url : 문자열을 포함한 변수. echo 문 내부의 스크립트에서도 활용 가능한 변수
?>