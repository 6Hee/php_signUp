<?php
    //로그 아웃시 : 세션 스토리지 내부에 key 항목을 제거하면 각각의 value 값도 동시에 삭제
    session_start();
    unset($_SESSION["userid"]);
    unset($_SESSION["username"]);
    unset($_SESSION["userlevel"]);
    unset($_SESSION["userpoint"]);
    //세션으로부터 등록된 모든 항목을 삭제(unset, destroy)

    echo ("
        <script>
            location.href='./';
        </script>
    ");

?>