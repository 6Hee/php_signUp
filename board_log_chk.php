<?php
    //로그인이 안된 상태로 접근을 했다면
    if(!$userid){
        echo ("
            <script>
                alert('로그인 후 이용 바랍니다.');
                location.href='./login_form.php?spot=board';
            </script>
        ");
    }
?>