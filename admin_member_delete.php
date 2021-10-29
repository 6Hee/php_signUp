<?php
    //http://localhost/oclass/admin_member_delete.php?num=9

    $num = $_GET["num"]; //9

    $sql = "delete from members where num='$num'";
    mysqli_query($con, $sql);
    mysqli_close($con);


    echo ("
        <script>
            location.href='./admin.php';
        </script>
    ");

?>