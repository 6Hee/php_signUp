<?php
    //http://localhost/oclass/board_download.php?num=2&real_name=2021_10_22_17_30_41.png&file_name=desktop-backgrounds-1.png&file_type=image/png

    $real_name = $_GET["real_name"];
    $file_name = $_GET["file_name"];
    $file_type = $_GET["file_type"];
    $file_path = "./data/".$real_name;

    /*
        var_dump($real_name);
        var_dump($file_name);
        var_dump($file_type);
        var_dump($file_path);
    */

    //file_exists(파일 경로 및 파일명) 내장함수 : 지정한 경로에 파일의 존재 유무를 판단. 존재하면 true, 없으면 false;
    //var_dump(file_exists($file_path));  //true
    if(file_exists($file_path)){
        //fopen() 내장함수 : 파일을 열어주겠다는 명령(현재 문서 입장에서 외부파일을 열어주겠다는 기능)
        //fopen(파일명 또는 파일에 대한 변수명, 파일모드, include path-파일경로)
        /*
        fopen()의 파일모드
            w : 파일 쓰기전용
            r : 파일의 읽고 쓰기
            b : 바이너리 데이터(컴퓨터 상의 원시 데이터 -> 컴퓨터 코딩상에서 구조화된 데이터값을 지칭 - 예시, 영화 메트릭스의 녹색 글자들)
        */
        //fclose() 내장함수 : 파일을 닫겠다는 명령
        $fp = fopen($file_path, "rb");
        //var_dump($fp);

        //Header() 내장함수 : HTTP 헤더를 전송하기 위해 사용 (html에서 메타정보를 설정 <meta Content-type="equiv">)
        Header("Content-type:application/x-msdownload");  //강제로 다운로드 시켜주게끔 만들어주는 정의문
        //application : '앱'은 DB와 연동되면서 하나 이상의 동작을 수행시켜주는 모든 형태. 이미지, 모든 문서형태, 비디오, 오디오 등
        //이미지 파일(gif)을 다운로드시 => Header("Content-type:image/gif/x-msdownload");

        Header("Content-Length:".filesize($file_path)); //파일 용량 사이즈를 전송
        Header("Content-Disposition:attachment; filename=".$file_name);  //파일의 오리지널 이름을 전송
        Header("Content-Transfer-Encoding:binary");  //컴퓨터 언어로 인코딩 방식을 통해서 전송
        Header("Content-Descripttion:File Transfer");  //파일에 대한 구체성을 변형된 형태로 전송
        Header("Expires:0");  //만료일에 대한 전송방식. "0"이라는 의미는 다운을 받자마자 캐시메모리에 저장을 시키지 않겠다는 의미(==> 이미 만료되었음)

        //캐시메모리 : 브라우저 화면을 열고 이동시키는 과정에서 이미지, 스타일, 문자들을 다운받아서 잠시 저장하는 공간
    }

    //fpassthru(변수명) : 외부파일 전체를 읽을 수 있는 함수
    if(!fpassthru($fp)){  //읽을 수 있는 파일이 존재하지 않다면
        fclose($fp);  //파일을 닫아주겠다는 의미
    }

    //외부 파일의 다운로드 단계
    /*
    fopen(변수명, 파일모드) -> fread(변수명) -> fclose(변수명) : 읽는 시간에 대한 소요가 발생
    fopen(변수명, 파일모드) -> fpassthru(변수명) : "fread(변수명) -> fclose(변수명)" 단계를 무시하고 바로 진행을 시킴으로써 실질적인 read에 대한 시간을 단축할 수 있음
    */
?>