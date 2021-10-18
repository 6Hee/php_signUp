<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>아이디 중복체크</title>
    <link rel="stylesheet" href="./css/idChk_pop.css">
</head>
<body>
    <h2 id="idChk_title">아이디 중복</h2>
    <div id="idChk_txt">
<?php
    //http://localhost/oclass/member_check_id.php?id=abc
    $id = $_GET["id"];
    //var_dump($id);
    if(!$id){
        //아이디 입력상자에 아무것도 입력하지 않은 상태에서 "중복체크"라는 버튼을 클릭했을 때
        //http://localhost/oclass/member_check_id.php?id=
        echo("<p>아이디를 입력해 주세요.</p>");
    }else{
        //아이디 입력상자에 어떠한 값이라도 입력한 후에 중복체크 버튼을 클릭 시
        //http://localhost/oclass/member_check_id.php?id=
        include "./db_con.php";


        $sql = "select * from members where id='$id'";
        //기존 DB에 동일한 id가 존재하는지를 찾는다. -> 만약 존재한다면 -> "아이디가 중복되었습니다."라는 문구를 띄워야 함. 다시 작성하도록 유도

        $result = mysqli_query($con, $sql);

        //$con : DB 접속 정보
        //$sql : 일반 문자 데이터를 sql로 명령어를 진행하도록 구성된다.
        //mysqli_query(접속정보, 명령 체계를 포함한 문자 데이터) : 1차 관문(접속 정보의 유효성을 검사) -> 2차 관문(sql 명령)

        //var_dump($result);  //객체화된 데이터들의 종합 정보

        $num_record = mysqli_num_rows($result);

        //var_dump($num_record); //int(1) : 동일한 아이디가 하나 존재한다. (true) / int(0) : 동일한 아이디가 존재하지 않는다.(false);

        if($num_record){
            echo "<p><b>".$id."</b>아이디는 중복된 아이디 입니다.</p><p>다른 아이디를 사용해 주세요.</p>";
        }else{
            echo "<p><b>".$id."</b>아이디는 사용 가능합니다.</p>";
        }

        mysqli_close($con);
    }

?>
    </div>

    <div id="close">
        <button type="button" onclick="self.close();">닫기</button>
    </div>
</body>
</html>


