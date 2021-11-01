<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>프로그램 상세 페이지</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/products.css">
</head>
<body>
    <header>
        <?php include "./header.php"?>
    </header>


<?php
    $num = $_GET["num"];

    include "./db_con.php";
    $sql = "select * from products where num='$num'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    $id = $row["id"];  //추후 "예약 문의" 용도의 메시지 보내기
    $title = $row["title"];
    $sub = $row["sub"];
    $content = $row["content"];
    $price = number_format($row["price"]);
    $fav = number_format($row["fav"]);
    $hit = $row["hit"];
    $file_copied = "./products/".$row["file_copied"];


    $new_hit = $hit + 1;
    $sql_hit_update = "update products set hit=$new_hit where num='$num'";
    mysqli_query($con, $sql_hit_update);
    //mysqli_close($con);


?>
    <section>
        <div id="product_box">
            <div id="product_detail">
                <div class="pd_view" style="background-image: url(<?=$file_copied?>);"></div>
                <div class="pd_txt">
                    <h3 class="pd_title"><?=$title?>
<?php
    $sql = "select * from fav where id='$userid' and pd_num='$num'";
    $result = mysqli_query($con, $sql);
    $row_num = mysqli_num_rows($result);
    //var_dump($row_num);

    if($row_num){  //좋아요 선택
?>
                        <span class="fav_icon"><img src="./img/fav_fill.svg" alt="좋아요 아이콘"></span>
<?php
    }else{
?>
                        <span class="fav_icon"><img src="./img/fav_empty.svg" alt="좋아요 아이콘"></span>
<?php
    }
?>
                    </h3>
                    <h4 class="pd_sub"><?=$sub?></h4>
                    <p class="pd_content"><?=$content?></p>
                    <div class="pd_etc">
                        <div class="pd_price"><span><?=$price?></span>원/H</div>
                        <div class="pd_fav" rel="<?=$num?>" data-userid="<?=$userid?>">좋아요&nbsp;<span><?=$fav?></span></div>
                        <input type="hidden" class="cur_fav" name="cur_fav" value="">
                    </div>

                    <div class="pd_ea">
                        <div><h4>예약시간</h4></div>
                        <div><input type="text" value="1"></div>
                    </div>

                    <ul class="pd_btn buttons">

<?php
    if($userid){
?>

                   
                        <li><button type="button" onclick="location.href='./message_form.php?num=<?=$num?>&id=<?=$id?>'">예약 문의</button></li><!--메세지 발송-->
<?php
    }
?>
                        <li><button type="button">카트 담기</button></li>
<?php
    if($userid){
?>
                        <li class="review_open"><button type="button">리뷰 등록</button></li>
<?php
    }
?>
                    </ul>

                    
                </div>
            </div>

            <!--리뷰 시작-->
            <div id="product_review">
                <div id="review_write">
                    <h3>리뷰 등록</h3>
                    <form name="product_review" action="./products_review_insert.php?num=<?=$num?>" method="post">
                        <div class="review_starSpace">
                            <ul class="review_starChk">
                                <li rel="1"><i class="fas fa-star"></i></li>
                                <li rel="2"><i class="fas fa-star"></i></li>
                                <li rel="3"><i class="fas fa-star"></i></li>
                                <li rel="4"><i class="fas fa-star"></i></li>
                                <li rel="5"><i class="fas fa-star"></i></li>
                            </ul>
                            <p><span class="star_rel">0</span> / 5</p>
                            <input type="text" name="star_score" value="">
                        </div>
                        <div class="review_textWrite">
                            <h4><?=$userid?></h4>
                            <textarea name="content" id="review_txt" maxlength="160" placeholder="160자 이내로 작성하세요."></textarea>
                            <button type="button" onclick="review_enroll();">등록</button>
                        </div>

                    </form>


                </div>
                <div id="review_list"></div>
            </div>


        </div><!--/#product_box 종료-->
    </section>

    <footer>
        <?php include "./footer.php"?>
    </footer>


    <script src="./js/products_view.js"></script>
</body>
</html>