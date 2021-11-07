<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OClass - CART</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/cart.css">
</head>
<body>
    <header>
        <?php include "./header.php"?>
    </header>


<?php
    include "./db_con.php";
    $sql = "select * from cart where id='$userid' order by num desc";
    $result1 = mysqli_query($con, $sql); //총 결제 금액을 뽑기 위한 용도 -> 하단의 for문에서 사용
    $result = mysqli_query($con, $sql); //실제 cart 리스트를 보여주기 위한 용도 -> 하단의 while문에서 사용
    $total_record = mysqli_num_rows($result);

    $pd_final_total = 0;

    for($i = 0; $i < $total_record; $i++){
        mysqli_data_seek($result1, $i);  //$result가 분해 되어버림
        $row1 = mysqli_fetch_array($result1);

        $pd_total_price1 = $row1["pd_total_price"];
        settype($pd_total_price1, "integer"); //문자형 데이터를 정수형 데이터로 변경

        $pd_final_total += $pd_total_price1; //숫자형 데이터
        $pd_final_total_format = number_format($pd_final_total); //세자리마다 콤마가 붙은 문자형 데이터
    }
?>


    <section>
        <div id="cart_box">
            <h2>CART 
<?php
    if($total_record){
?>
                <span class="final_total"> ( <span class="final_num"><?=$total_record?></span> ) </span>
<?php
    }
?>
            </h2>
            <form name="cartList" action="./cart_list_delete.php" method="post">
                <ul class="list_btn">
                    <li><button type="submit">선택 삭제</button></li>
                </ul>

                <ul class="cart_list">
                    <li>
                        <span class="field1">선택</span>
                        <span class="field2">이미지</span>
                        <span class="field3">프로그램</span>
                        <span class="field4">예약일</span>
                        <span class="field5">기본요금(원)</span>
                        <span class="field6">예약시간</span>
                        <span class="field7">예약요금(원)</span>
                    </li>
<?php
    while($row = mysqli_fetch_array($result)){
        $num = $row["num"];
        $pd_num = $row["pd_num"];
        $pd_title = $row["pd_title"];
        $pd_img = "./products/".$row["pd_img"];
        $regist_day = $row["regist_day"];
        $pd_price = $row["pd_price"];
        $pd_price_format = number_format($pd_price);
        $pd_ea = $row["pd_ea"];
        $pd_total_price = $row["pd_total_price"];
        $pd_total_price_format = number_format($pd_total_price);
?>
                    <li class="cart_detail">
                        <span class="field1"><input type="checkbox" name="unit[]" value="<?=$num?>"></span>
                        <span class="field2">
                            <a href="./products_view.php?num=<?=$pd_num?>" style="background-image: url(<?=$pd_img?>)"></a>
                        </span>
                        <span class="field3">
                            <a href="./products_view.php?num=<?=$pd_num?>"><?=$pd_title?></a>
                        </span>
                        <span class="field4"><?=$regist_day?></span>
                        <span class="field5 price" price="<?=$pd_price?>"><?=$pd_price_format?></span>
                        <span class="field6">
                            <a class="minus" href="">－</a>
                            <input type="text" value="<?=$pd_ea?>" readonly>
                            <a class="plus" href="">＋</a>
                        </span>
                        <span class="field7 total" total="<?=$pd_total_price?>"><?=$pd_total_price_format?></span>
                    </li>
<?php
    }
?>
                </ul>
            </form>

            <div class="total_pay">
                <h3 class="pay_title">총 결제 금액</h3>
                <h3 class="pay_price" final-total="<?=$pd_final_total?>"><span><?=$pd_final_total_format?></span>원</h3>
            </div>
            <ul class="buttons">
                <li><button>결제하기</button></li>
            </ul>
        </div>
    </section>



    <footer>
        <?php include "./footer.php"?>
    </footer>

    <script src="./js/cart.js"></script>
</body>
</html>