<div id="main_banner" class="mainpage">
    <div class="main_img_cont">
        <ul id="slider">

<?php
    include "./db_con.php";
    $sql = "select * from products order by num desc limit 4"; //제한을 걸어준다.
    $result = mysqli_query($con, $sql);

    while($row = mysqli_fetch_array($result)){
        var_dump($row);
        $file_copied = "./products/".$row["file_copied"];
        $title = $row["title"];
        $sub = $row["sub"];
        $num = $row["num"];  //링크 연동

?>

            <li class="slide">
                <div class="slide_img" style="background-image: url(<?=$file_copied?>);">
                    <div class="wrap">
                        <div class="txt_space">
                            <h2><?=$title?></h2>
                            <p><?=$sub?></p>
                            <a href="./products_view.php?num=<?=$num?>">Detail More</a>
                        </div>
                    </div>
                </div>
            </li>

<?php
    }
?>

        </ul>
    </div>
</div>



<!-- 프로그램 - 인기순 -->
<div class="main_cont">
    <div class="program">
        <h2>Best 프로그램 <a href="./products_list.php">+</a></h2>
        <ul class="products_list">

<?php
    $sql = "select * from products order by fav desc limit 8";
    $result = mysqli_query($con, $sql);

    while($row = mysqli_fetch_array($result)){
        $file_copied = "./products/".$row["file_copied"];
        //var_dump($file_copied);
        $title = $row["title"];
        $sub = $row["sub"];
        $price = number_format($row["price"]);
        $fav = number_format($row["fav"]);
        $num = $row["num"];  //링크 연동
?>
            <li onclick="location.href='./products_view.php?num=<?=$num?>'">
                <div class="pd_img">
                    <div class="pd_bg" style="background-image: url(<?=$file_copied?>);"></div>
                </div>
                <div class="pd_cont">
                    <h3 class="pd_title"><?=$title?></h3>
                    <p class="pd_sub"><?=$sub?></p>
                    <div class="pd_info">
                        <div class="pd_price"><span><?=$price?></span>원</div>
                        <div class="pd_fav"><img src="./img/fav_fill.svg" alt=""><span><?=$fav?></span></div>
                    </div>
                </div>
            </li>
<?php
    }
?>
        </ul>
    </div>
</div>

<!--공지사항 & 우수회원(admin 제외)-->
<div id="main_info">
    <div class="wrap">
        <div class="board">
            <h2>공지사항 <a href="./board_list.php">＋</a></h2>
            <ul>
<?php
    //최신 게시글 5개만 화면에 보여줄 것!!!
    $sql = "select * from board where notice='1' order by num desc limit 5";
    //게시판으로부터 모든 데이터 베이스를 접근하여 가져오되 역순으로 5개의 행만 가져온다.
    $result = mysqli_query($con, $sql);
    if(!$result){  //아직 게시글이 하나라도 등록되어 있지 않다면
        echo "<li class='board_blank'><span>현재, 등록된 게시글이 없습니다.</span></li>";
    }else{  //게시들이 하나 이상 존재한다면
        while($row = mysqli_fetch_array($result)){
            $num = $row["num"];  //상세페이지로 접근을 시킬 수 있는 도구
            $subject = $row["subject"];
            $name = $row["name"];
            $regist_day = substr($row["regist_day"], 0, 10);

            //var_dump($regist_day);
            //2021-10-25 (17:53)  ==<문자열 추출>==> 2021-10-25
            //==> [자바스크립트-문자열 추출] 문자열.substr(최초로 시작하는 인덱스번호, 문자개수) 
            //==> [php-문자열 추출] substr(문자열(변수), 최초로 시작하는 인덱스번호, 문자개수)  ==> substr("2021-10-25 (17:53)", 0, 10)
?>
                <li>
                    <span class="field1"><a href="./board_view.php?num=<?=$num?>&page=1"><?=$subject?></a></span>
                    <span class="field2"><?=$name?></span>
                    <span class="field3"><?=$regist_day?></span>
                </li>
<?php
        }//while문 종료
    }//else문 종료
?>
            </ul>
        </div>
<!--주말 과제인 FAQ 대체 - 제목만 넣는다.(클릭하면 FAQ 상세 페이지로 보낸다.)-->        

<!--
        <div class="member">
            <h2>우수멤버 </h2>
            <ul>
<?php
    //관리자는 배제시킨다. 
    $rank = 1;
    $sql = "select * from members where level not in('1') order by point desc limit 5";
    $result = mysqli_query($con, $sql);

    if(!$result){  //등록회원이 없는 상태
        echo "<li class='member_blank'><span>등록회원이 없습니다.</span></li>";
    }else{
        while($row = mysqli_fetch_array($result)){
            $name = $row["name"];
            $id = $row["id"];
            $point = number_format($row["point"]);
?>
            <li>
                <span class="field1"><?=$rank?></span>
                <span class="field2"><?=$name?></span>
                <span class="field3"><?=$id?></span>
                <span class="field4"><?=$point?></span>
            </li>
<?php
            $rank++;
        }        
    }
?>
            </ul>
        </div>
--><!--우수회원 종료 (안보임)-->
        <div class="faq">
            <h2>FAQ <a href="./faq_list.php">＋</a></h2>
            <ul>
<?php
    $listNum = 0;  //faq_list.php가 열렸을 때 해당 클릭한 곳의 답변 항목이 열린 상태로 나오도록 접근시킬 도구
    $sql = "select subject from faq order by num limit 5";
    $result = mysqli_query($con, $sql);

    while($row = mysqli_fetch_array($result)){
        $subject = $row["subject"];
?>
                <li><a href="./faq_list.php?listNum=<?=$listNum?>"><?=$subject?></a></li>
<?php
        $listNum++;
    }
?>
            </ul>
        </div>
    </div>
</div>





<!--프로그램 - 신상품-->

<div class="main_cont">
    <div class="program">
        <h2>NEW 프로그램 <a href="./products_list.php">＋</a></h2>
        <ul class="products_list">
<?php
    $sql = "select * from products order by num desc limit 8";
    $result = mysqli_query($con, $sql);


    while($row = mysqli_fetch_array($result)){
        $num = $row["num"];
        $file_copied = "./products/".$row["file_copied"];
        $title = $row["title"];
        $sub = $row["sub"];
        $price = number_format($row["price"]);
        $fav = number_format($row["fav"]);
?>
            <li onclick="location.href='./products_view.php?num=<?=$num?>'">
                <div class="pd_img">
                    <div class="pd_bg" style="background-image: url(<?=$file_copied?>);"></div>
                </div>
                <div class="pd_cont">
                    <h3 class="pd_title"><?=$title?></h3>
                    <p class="pd_sub"><?=$sub?></p>
                    <div class="pd_info">
                        <div class="pd_price"><span><?=$price?></span>원</div>
                        <div class="pd_fav"><img src="./img/fav_fill.svg" alt=""><span><?=$fav?></span></div>
                    </div>
                </div>
            </li>
<?php
    }
?>

        </ul>
    </div>
</div>





