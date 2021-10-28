<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OClass - 로그인</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>

<?php
    //(메세지로부터 유입)http://localhost/oclass/login_form.php?spot=message
    //(게시판으로부터 유입)http://localhost/oclass/login_form.php?spot=board
    //(프로그램 작성 페이지로부터 유입)http://localhost/oclass/login_form.php?spot=products
    //(프로그램 상세 페이지에서 좋아요 버튼 클릭시)http://localhost/oclass/login_form.php?spot=productsFav&pdNum=10

    if(isset($_GET["spot"])){
        $spot = $_GET["spot"];

    }else{
        $spot = "";
    }
    //var_dump($spot);
    if(isset($_GET["pdNum"])){
        $pdNum = $_GET["pdNum"];
    }else{
        $pdNum = "";
    }
?>


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

        <div id="main_content">
            <div id="login_box">
                <form name="login_form" action="./login_ok.php?spot=<?=$spot?>&pdNum=<?=$pdNum?>" method="post">
                    <h2>로그인</h2>
                    <ul>
                        <li><input type="text" name="id" placeholder="아이디 입력" autocomplete="off"></li>
                        <li><input type="password" name="pass" placeholder="비밀번호 입력" autocomplete="off"></li>
                    </ul>
                    <div id="login_btn">
                        <button type="button" onclick="check_input();">로그인</button>
                    </div>
            
                </form>

            </div>
        </div>

    </section>
    <footer>
        <?php include "./footer.php"?>
    </footer>

    <script src="./js/login.js"></script>

</body>
</html>