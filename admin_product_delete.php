<?php

    //체크 항목의 개수 파악
    if(isset($_POST["unit"])){
        $num_unit = count($_POST["unit"]);
        //var_dump($num_unit); //체크한 상자의 개수
    }else{
        echo ("
            <script>
                alert('삭제할 게시글을 선택하세요');
                history.go(-1);
            </script>
        ");
    }

    
    include "./db_con.php";
    for($i = 0; $i < $num_unit; $i++){
        $num_index = $_POST["unit"][$i];
        //var_dump($num_index);
        $sql = "select * from products where num='$num_index'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);

        //#1. data라는 폴더에 저장된 첨부파일을 삭제
        $file_copied = $row["file_copied"];
        if($file_copied){
            $file_path = "./products/".$file_copied;
            unlink($file_path);
        }

        //#2. board 라는 테이블에서 존재하는 선택항목을 삭제
        $sql = "delete from products where num='$num_index'";
        mysqli_query($con, $sql);
    }

    mysqli_close($con);

    echo("
        <script>
            location.href='./admin.php';
        </script>
    ");
    
?>