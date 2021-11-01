<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ 작성하기</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/faq.css">
</head>
<body>
    <header>
		<?php include "./header.php"; ?>
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

        <div id="faq_box">
            <h2 id="faq_title">FAQ 작성하기</h2>
            <form name="faq_form" action="./faq_insert.php" method="post">
                <ul id="faq_form">
                    <li>
                        <div class="label">
                            <label for="">작성자</label>    
                        </div>
                        <div class="input">
                            <p><?=$userid?></p>
                        </div>
                    </li>
                    <li>
                        <div class="label">
                            <label for="subject">제목 : </label>
                        </div>
                        <div class="input">
                            <input type="text" name="subject" id="subject1">
                        </div>
                    </li>
                    <li>
                        <div class="label">
                            <label for="content">내용</label>
                        </div>
                        <div class="input">
                            <textarea name="content" id="content1"></textarea>
                        </div>
                    </li>
                </ul>

                <ul class="buttons">
                    <li><button type="button" onclick="check_input();">작성 완료</button></li>
                    <li><button type="button" onclick="location.href='./faq_list.php'">목록 보기</button></li>
                </ul>
            </form>
        </div>
    </section>
    <footer>
        <?php include "./footer.php" ?>
    </footer>

    <script src="./js/faq.js"></script>
</body>
</html>