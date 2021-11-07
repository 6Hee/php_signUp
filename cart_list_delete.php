<?php
    if(isset($_POST["unit"])){
        $num_unit = count($_POST["unit"]);
    }else{
        echo ("
            <script>
                alert('삭제할 상품을 선택하세요.');
                history.go(-1);
            </script>
        ");
    }


    include "./db_con.php";
    for($i = 0; $i < $num_unit; $i++){
        $num_index = $_POST["unit"][$i];

        $sql = "delete from cart where num='$num_index'";
        mysqli_query($con, $sql);
    }
    mysqli_close($con);

    echo ("
        <script>
            location.href='./cart_list.php';
        </script>
    ");
?>