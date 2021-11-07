<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OClass - Main</title>
    <link rel="stylesheet" href="./slick/slick.css">
    <link rel="stylesheet" href="./slick/slick-theme.css">
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/pop.css">
    <link rel="stylesheet" href="./css/main.css">
</head>
<body>
    <header>
        <?php include "./header.php"?>
    </header>
    <section>
        <?php include "./main.php"?>
    </section>
    <footer>
        <?php include "./footer.php"?>
    </footer> 

    <div id="dark" class="active"></div>
    <div id="popup" class="active">
        <div class="close">×</div>
        <div class="pop_cont">
            <img src="./img/products_img/home_banner.jpg" alt="">
            <h3>관리자 : admin / 1111</h3>
            <h3>회원1 : abc / 1111</h3>
            <h3>회원2 : node / 1111</h3>
        </div>
        <div class="pop_btn">
            <button type="button" onclick="todayClosePop();">하루동안 열리지 않기</button>
        </div>
    </div>

    <script src="./slick/slick.js"></script>
    <script src="./js/pop.js"></script>
    <script src="./js/main.js"></script>
</body>
</html>