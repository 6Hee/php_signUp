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

                <form name="login_form" action="./login_ok.php" method="post">
                    <h2>로그인</h2>
                    <ul>
                        <li><input type="text" name="id" placeholder="아이디 입력" autocomplete="off"></li>
                        <li><input type="password" name="pass" placeholder="비밀번호 입력" autocomplete="off"></li>
                    </ul>
                    <div id="login_btn">
                        <button type="button" onclick="check_input();">
                            로그인
                        </button>
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