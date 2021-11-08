<?php
    //로그인 된 상태? 비로그인 상태? (후 처리)
    session_start();

    if(isset($_SESSION["userid"])){
        $userid = $_SESSION["userid"];
    }else{
        $userid = "";
        echo ("
            <script>
            
                alert('로그인 후 이용 바랍니다');
                location.href='./login_form.php?spot=products';
            </script>
        ");
    }

    if(isset($_SESSION["username"])){
        $username = $_SESSION["username"];
    }else{
        $username = "";
    }

    $title = str_replace("'", "&#39;", $_POST["title"]);
    $sub = str_replace("'", "&#39;", $_POST["sub"]);
    $content = str_replace("'", "&#39;", $_POST["content"]);
    $detail = str_replace("'", "&#39;", $_POST["detail"]);
    $price = $_POST["price"];
    $regist_day = date("YmdHis");
    //var_dump($regist_day);

    //첨부파일 저장공간 구성
    $upload_dir = "./products/";
    $upfile = $_FILES["upfile"];
    //var_dump($upfile);
    $upfile_name = $_FILES["upfile"]["name"]; //업로드한 실제 파일명
    $upfile_tmp_name = $_FILES["upfile"]["tmp_name"]; //임시 저장한 파일
    //저장한 첨부파일은 c:\fakePath/파일명 (서버가 없는 상태의 HTML 문서에서 첨부파일 저장시)
    $upfile_type = $_FILES["upfile"]["type"]; //첨부파일의 파일형식
    $upfile_size = $_FILES["upfile"]["size"]; //첨부파일의 크기
    $upfile_error = $_FILES["upfile"]["error"]; //파일의 정상 또는 비정상


    //var_dump($upfile_size);


    if($upfile_name && !$upfile_error){
        $file_replace = substr_replace($upfile_name, "|", strrpos($upfile_name, "."), 1);

        $file = explode("|", $file_replace);
        //var_dump($file); //["jquery_min", "js"];

        $file_name = $file[0];  //파일의 형식을 제외한 이름만 저장
        $file_ext = $file[1];  //파일의 형식만을 저장 
        //var_dump($file_name);
        //var_dump($file_ext);

        //파일 확장자의 조건식을 구성
        if($file_ext == "png" || $file_ext == "jpg" || $file_ext == "jpeg" || $file_ext == "gif"){
            $new_file_name = date("Y_m_d_H_i_s");
            $copied_file_name = $new_file_name.".".$file_ext;
            $uploaded_file = $upload_dir.$copied_file_name;
            if($upfile_size > 5000000){ //첨부파일의 용량이 5mb를 초과한다면
                echo ("
                    <script>
                        alert('업로드한 파일의 크기가 5MB를 초과했습니다. \n파일 사이즈를 조정하여 다시 업로드 바랍니다.');
                        history.go(-1);
                    </script>
                ");
            }else{
                move_uploaded_file($upfile_tmp_name, $uploaded_file);
            }

        }else{
            echo ("
            <script>
                alert('상품 등록 이미지의 형식은 jpg, jpeg, png, gif의 형식만 가능합니다.');
                history.go(-1);
            </script>
        ");
        }


    }else{  //파일 이름이 존재하지 않거나 또는 에러가 발생하였다면

        $upfile_name = "";
        $upfile_type = "";
        $copied_file_name = "";

    }

    //DB 전송
    include "./db_con.php";
    $sql = "insert into products (id, name, title, sub, content, detail, price, fav, hit, regist_day, file_name, file_type, file_copied)";
    $sql .= "values('$userid', '$username', '$title', '$sub', '$content', '$detail', '$price', 0, 0, '$regist_day', '$upfile_name', '$upfile_type', '$copied_file_name')";



    mysqli_query($con, $sql);
    mysqli_close($con);

    echo ("
        <script>
            location.href='./products_list.php';
        </script>    
    ");
    /*

    if($upfile_type == "image/png" || $upfile_type == "image/jpg" || $upfile_type == "image/jpeg" || $upfile_type == "image/gif"){

    }else{
        echo ("
            <script>
                alert('상품 등록 이미지의 형식은 jpg, jpeg, png, gif의 형식만 가능합니다.');
            </script>
        ");
    }
    */
?>


