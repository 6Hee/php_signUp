<?php
    //http://localhost/oclass/board_delete.php?num=11&page=1
    $num = $_GET["num"];
    $page = $_GET["page"];


    include "./db_con.php";

    //만약 게시글을 삭제할 경우, 첨부파일도 삭제처리
    $sql = "select * from board where num='$num'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    //이 데이터 중에서 data라는 폴더에 저장된 실제 파일명을 가져온다. -> 삭제
    $copied_name = $row["file_copied"];
    //var_dump($copied_name); //string(23) "2021_10_26_08_55_57.jpg"
    if($copied_name){
        $file_path = "./data/".$copied_name; //경로까지 연결한 파일명

        unlink($file_path);
        //unlink(저장된 파일의 경로까지 포함된 변수명 또는 데이터)
    }


    //본인이 작성하고 상세페이지까지 접근한 게시글을 삭제(DB에 저장된 문서 또는 숫자 데이터를 삭제 처리)

    $sql_delete = "delete from board where num='$num'";
    mysqli_query($con, $sql_delete);
    mysqli_close($con);

    echo("
        <script>
            location.href='./board_list.php?page=$page';
        </script>
    ");

?>