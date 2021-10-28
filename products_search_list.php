<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>프로그램 리스트</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/products.css">
</head>
<body>

    <header>
        <?php include "./header.php"?>
    </header>

    <section>
        <div class="subpage">
            <div class="frame">
                <div class="banner_title">
                    <h3>100% <span>Online Course</span></h3>
                    <h1>Get Future's Skill Today!</h1>
                </div>
            </div>
        </div>




        <!--검색바 추가 공간-->
        <div id="search">
            <div class="wrap">
                <form name="search" action="./products_search_list.php" method="post">
                    <input type="text" name="searchTxt" placeholder="검색어 입력" autocomplete="off">
                    <button type="button">검색</button>
                </form>
            </div>
        </div>
<?php

    //products_list.php --(검색어를 입력하여 결과 화면을 보여준상태)--> products_search_list.php
    //products_search_list.php --(검색어를 입력하여 결과 화면을 보여준 상태)--> products_search_list.php (루프 : loop - 반복진행)



    if(isset($_POST["searchTxt"])){

        $searchTxt = $_POST["searchTxt"];
    }else{
        $searchTxt = "";
    }
    //var_dump($searchTxt);

    

    //products_search_list.php --검색어 입력 없이 나온 결과 화면에서 sort(00순으로 정렬) 버튼 클릭 - 기존 들어온 검색어를 URL 창에 함께 실려 보낸다. --> products_
    if(isset($_GET["word"])){
        $word = $_GET["word"];
    }else{
        $word = "";
    }

/*
    if(!$searchTxt){
        echo ("
            <script>
                history.go(-1);
            </script>
        ");

    }
*/
    if(isset($_GET["sort"])){
        $sort = $_GET["sort"];
    }else{
        $sort = "";
    }



    include "./db_con.php";
    //$sql = "select * from products where title like '%$searchTxt%' order by num desc";

    if($searchTxt){

    
        if(!$sort){ //최초로 상단 메뉴인 프로그램 메뉴로부터 접근
            
            $sql = "select * from products where title like '%$searchTxt%' order by num desc";
        }else if($sort == "newSort"){

            $sql = "select * from products where title like '%$searchTxt%' order by num desc";
        }else if($sort == "hitSort"){

            $sql = "select * from products where title like '%$searchTxt%' order by hit desc";
        }else if($sort == "lowSort"){

            $sql = "select * from products where title like '%$searchTxt%' order by price";
        }else if($sort == "highSort"){

            $sql = "select * from products where title like '%$searchTxt%' order by price desc";
        }else if($sort == "favSort"){

            $sql = "select * from products where title like '%$searchTxt%' order by fav desc";
        }


        
    }elseif($word){
        if(!$sort){  //최초로 상단 메뉴인 프로그램 메뉴로부터 접근
            $sql = "select * from products where title like '%$word%' order by num desc";
        }elseif($sort == "newSort"){
            $sql = "select * from products where title like '%$word%' order by num desc";
        }elseif($sort == "hitSort"){
            $sql = "select * from products where title like '%$word%' order by hit desc";
        }elseif($sort == "lowSort"){
            $sql = "select * from products where title like '%$word%' order by price";
        }elseif($sort == "highSort"){
            $sql = "select * from products where title like '%$word%' order by price desc";
        }elseif($sort == "favSort"){
            $sql = "select * from products where title like '%$word%' order by fav desc";
        }

    }

    $result = mysqli_query($con, $sql);
    $total_record = mysqli_num_rows($result);


?>
        <div id="search_result">
            <h3><span><?=$searchTxt?></span> 검색결과 : <?=$total_record?>개</h3>
        </div>

        <!--프로그램 리스트-->
        <div id="product_box">
            <h2 id="product_title">프로그램 > 리스트</h2>

<?php
    if($searchTxt){
?>
            <div id="sort_btn">
                <ul>
                    <li><button type="button" class="newSort active" onclick="location.href='./products_search_list.php?sort=newSort&word=<?=$searchTxt?>'">최신순</button></li>
                    <li><button type="button" class="hitSort" onclick="location.href='./products_search_list.php?sort=hitSort&word=<?=$searchTxt?>'">조회순</button></li>
                    <li><button type="button" class="lowSort" onclick="location.href='./products_search_list.php?sort=lowSort&word=<?=$searchTxt?>'">저가순</button></li>
                    <li><button type="button" class="highSort" onclick="location.href='./products_search_list.php?sort=highSort&word=<?=$searchTxt?>'">고가순</button></li>
                    <li><button type="button" class="favSort" onclick="location.href='./products_search_list.php?sort=favSort&word=<?=$searchTxt?>'">인기순</button></li>
                </ul>
            </div>
<?php
    }elseif($word){
?>

            <div id="sort_btn">
                <ul>
                    <li><button type="button" class="newSort active" onclick="location.href='./products_search_list.php?sort=newSort&word=<?=$word?>'">최신순</button></li>
                    <li><button type="button" class="hitSort" onclick="location.href='./products_search_list.php?sort=hitSort&word=<?=$word?>'">조회순</button></li>
                    <li><button type="button" class="lowSort" onclick="location.href='./products_search_list.php?sort=lowSort&word=<?=$word?>'">저가순</button></li>
                    <li><button type="button" class="highSort" onclick="location.href='./products_search_list.php?sort=highSort&word=<?=$word?>'">고가순</button></li>
                    <li><button type="button" class="favSort" onclick="location.href='./products_search_list.php?sort=favSort&word=<?=$word?>'">인기순</button></li>
                </ul>
            </div>
<?php
    }
?>

            <ul id="product_list">
<?php

   

    for($i = 0; $i < $total_record; $i++){
        mysqli_data_seek($result, $i); //각 인덱스 번호($i)에 의한 각 행의 데이터들로 접근한다. => 각 데이터들은 $result마다 담는다.
        $row = mysqli_fetch_array($result);
        $num = $row["num"]; //프로그램의 고유 식별 번호 추적하여 상세 페이지에서 해당하는 프로그램을 열어주기 위한 도구 products_view.php?num=2
        $title = $row["title"];
        $sub = $row["sub"];
        $price = number_format($row["price"]);
        $fav = number_format($row["fav"]);
        $file_copied = "./products/".$row["file_copied"];
?>

                <li onclick="location.href='./products_view.php?num=<?=$num?>'">
                    <div class="pd_img">
                        <div class="img" style="background-image: url(<?=$file_copied?>);"></div>
                    </div>
                    <h3 class="pd_title"><?=$title?></h3>
                    <p class="pd_sub"><?=$sub?></p>
                    <div class="pd_info">
                        <div class="pd_price"><span><?=$price?></span>원</div>
                        <div class="pd_fav">좋아요&nbsp;<span><?=$fav?></span></div>
                    </div>
                </li>
<?php
    }
?>

            </ul>
<?php
    if($userid){  //로그인한 사용자만 접근
        if($userlevel < 6){  //레벨값이 6 미만인 사용자만 접근 = 판매자
    
?>
            <ul class="buttons">
                <li><button type="button" onclick="location.href='./products_form.php'">등록하기</button></li>
            </ul>
<?php
        }
    }
?>
        </div>


    </section>

    <footer>
        <?php include "./footer.php"?>
    </footer>


    <script src="./js/products_search.js"></script>

</body>
</html>