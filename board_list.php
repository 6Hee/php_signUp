<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OClass - 게시판 리스트</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/board.css">
</head>
<body>
    <header>
        <?php include "./header.php"?>
    </header>

    <!--로그인 된 회원만 게시판 작성하기 허용-->
    <?php include "./board_log_chk.php"?>

    
    <section>
        <div class="subpage">
            <div class="frame">
                <div class="banner_title">
                    <h3>100% <span>Online Course</span></h3>
                    <h1>Get Future's Skill Today!</h1>
                </div>
            </div>
        </div>
    </section>


    <footer>
        <?php include "./footer.php"?>
    </footer>
        

</body>
</html>
