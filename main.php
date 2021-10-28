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
        <h2>Best 프로그램</h2>
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








<!-- 프로그램 - 신상품 -->