<?php
    //http://localhost/oclass/board_modify.php?num=2&page=2
    $num = $_GET["num"];
    $page = $_GET["page"];

    //제목과 내용 작성간 ''(작은 따옴표)로 기입한 경우, DB로 전송 불가
    $subject = str_replace("'", "&#39;", $_POST["subject"]);

    //textarea에서 예시글로 "700자 이내로 작성해 주세요."라는 문구에 근거해서 통제 시스팀을 구축
    if(strlen($_POST["content"]) > 2100){  //초성 1byte, 중성 1byte, 종성 1byte  ==>  한글은 한 글자당 3byte
        echo ("
            <script>
                alert('입력한 내용의 글자수(한글 기준)가 700자를 초과하였습니다. \n확인 후 조정 바랍니다.');
                history.go(-1);
            </script>
        ");
    }else{
        $content = str_replace("'", "&#39;", $_POST["content"]);
    }

    //var_dump($subject);
    //var_dump($content);

    //$regist_day = date("Y-m-d (H:i)");
    $notice = $_POST["notice"];


    //첨부파일 저장하는 구성
    //첨부파일의 저장 공간은 data 폴더
    $upload_dir = "./data/";  //저장공간(디렉토리) 정의
    $upfile = $_FILES["upfile"];
    //var_dump($upfile);
    /*
    array(5) { 
        ["name"]=> string(25) "desktop-backgrounds-1.png" 
        ["type"]=> string(9) "image/png" 
        ["tmp_name"]=> string(49) "C:\Bitnami\wampstack-8.0.11-0\php\tmp\php6128.tmp" 
        ["error"]=> int(0) 
        ["size"]=> int(205934) 
    }    
    */
    $upfile_name = $_FILES["upfile"]["name"];  //업로드한 최초 이름
    $upfile_tmp_name = $_FILES["upfile"]["tmp_name"];  //첨부파일에 부여된 다른 임시이름
    $upfile_type = $_FILES["upfile"]["type"];  //파일의 형식 또는 형태
    $upfile_size = $_FILES["upfile"]["size"];  //파일의 크기(단위는 byte)
    $upfile_erro = $_FILES["upfile"]["error"];  //파일 에러사항(예시, 파일이 깨진경우)

    /*
    var_dump($upfile_name); //string(25) "desktop-backgrounds-1.png"
    var_dump($upfile_tmp_name);  //string(49) "C:\Bitnami\wampstack-8.0.11-0\php\tmp\phpD1E8.tmp"
    var_dump($upfile_type);  //string(9) "image/png"
    var_dump($upfile_size);  //int(205934)
    var_dump($upfile_erro);  //int(0) => 에러없음
    */
    if($upfile_name && !$upfile_erro){  //첨부파일의 이름이 존재하고, 에러가 없다면

        $lastPointIndexNum = strrpos($upfile_name, ".");  //jquery.min.js 파일 이름을 가진 파일을 첨부파일로 넣었을 때, 
        //var_dump($lastPointIndexNum);  //int(10)

        //$pointIndexNum = strpos($upfile_name, ".");

        //strrpos("문자열 대상", "지정문자") : 문자열 마지막부터 지정문자를 찾아서 해당하는 곳의 인덱스번호(좌측으로부터 0번 인덱스)를 반환시킴 =~ [javascript] lastIndexOf

        //strpos("문자열 대상", "지정문자") : 문자열 처음부터 지정문자를 찾아서 해당하는 곳의 인덱스번호(좌측으로부터 0번 인덱스)를 반환시킴 =~ [javascript] indexOf

        $file_replace = substr_replace($upfile_name, "|", strrpos($upfile_name, "."), 1);  //substr_replace("문자열" 또는 문자열의 데이터가 담긴 변수, "지정문자", 인덱스 번호, 개수); => 문자열에서 지정문자를 인덱스 번호부터 개수만큼의 자리에 변경하여 넣겠다는 의미 
        //var_dump($file_replace);  //"jquery.min|js"

        $file = explode("|", $file_replace);
        var_dump($file);  //["jquery.min", "js"]


        //$file = explode(".", $upfile_name);  //지정한 문자를 기준으로 문자열을 분리하여 배열화시킨다. 
        //var_dump($file);  //array(2) { [0]=> string(21) "desktop-backgrounds-1" [1]=> string(3) "png" }
        $file_name = $file[0];  //[0]=> string(21) "desktop-backgrounds-1"
        $file_ext = $file[1];  //[1]=> string(3) "png"

        //동일한 이름의 이미지 파일이 존재하지 않도록 네이밍을 진행(업데이트 된 날짜를 기준으로 네이밍 작업을 진행)  data/img_01.jpg => data/img_01 (1).jpg
        $new_file_name = date("Y_m_d_H_i_s");
        //var_dump($new_file_name);  //string(19) "2021_10_22_15_39_30"

        $copied_file_name = $new_file_name.".".$file_ext;  //2021_10_22_15_39_30.png
        $uploaded_file = $upload_dir.$copied_file_name;
        //var_dump($uploaded_file);  //string(30) "./data/2021_10_22_15_39_30.png"

        //첨부파일 용량을 제한
        if($upfile_size > 5000000){
            echo ("
                <script>
                    alert('업로드한 첨부파일의 크기가 5MB를 초과하였습니다. \n파일 사이즈를 조정하여 다시 업로드 바랍니다.');
                    history.go(-1);
                </script>
            ");
        }else{
            //실제 데이터 베이스를 기반으로 지정된 장소(폴더 또는 디렉토리)에 파일을 저장
            //move_uploaded_file() 내장함수로 서버에 임시저장된 $upfile_tmp_name(컴퓨터만 해독 가능한 파일)을 $uploaded_file(사용자가 볼 수 있는 파일)의 값인 경로에 파일명 형태로 저장. 파일명의 중복 현상을 최소화할 수 있음.
            move_uploaded_file($upfile_tmp_name, $uploaded_file);
            //move_uploaded_file(파일, newLocation);
            // - 파일 : 업로드 된 임시파일
            // - newLocation : 경로를 포함한 파일명(반드시 확장자 포함) => 인입 결과를 확인 가능하도록 구성
        }
    }else{  //파일의 이름이 존재하지 않거나 에러가 발생했다면
        //기존 변수를 초기화시킴
        $upfile_name = "";
        $upfile_type = "";
        $copied_file_name = "";
    }

    include "./db_con.php";

    $sql = "update board set subject='$subject', content='$content',file_name='$upfile_name', file_type='$upfile_type', file_copied='$copied_file_name',notice = '$notice' where num='$num'";
    mysqli_query($con, $sql);
    mysqli_close($con);


    //업데이트(수정) 종료 이후에 리스트 항목으로 보낼 것이다. (조건 1) - $page 포함
    echo ("
        <script>
            location.href='./board_list.php?page=$page';
        </script>
    ");


    //업데이트(수정) 종료 이후에 상세 페이지로 보낼 것이다. (조건 2)

?>