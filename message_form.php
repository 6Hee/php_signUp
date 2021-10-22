<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OClass - 메세지 작성</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/message.css">
</head>
<body>
    <header>
        <?php include "./header.php" ?>
    </header>

    <?php include "./message_log_chk.php"?>

    <section>
        <div class="subpage">
            <div class="frame">
                <div class="banner_title">
                    <h3>100% <span>Online Course</span></h3>
                    <h1>Get Future's Skill Today!</h1>
                </div>
            </div>
        </div>

        <div id="message_box">
            <h2>메세지 보내기</h2>
            <ul class="top_buttons">
                <li><a href="./message_box.php?mode=rv">받은 메세지</a></li>
                <li><a href="./message_box.php?mode=send">보낸 메세지</a></li>
            </ul>
            <form name="message_form" action="./message_insert.php?send_id=<?=$userid?>" method="post">
                <div id="write_msg">
                    <ul>
                        <li>
                            <div class="label_box">
                                <label for="id">보내는 사람</label>
                            </div>
                            <div class="input_box">
                                <p><?=$userid?></p>
                            </div>
                        </li>
                        <li>
                            <div class="label_box">
                                <label for="rv_id">받는 사람(아이디)</label>
                            </div>
                            <div class="input_box">
                                <input type="text" name="rv_id" id="rv_id">
                            </div>
                        </li>
                        <li>
                            <div class="label_box">
                                <label for="subject">제목</label>
                            </div>
                            <div class="input_box">
                                <input type="text" name="subject" id="subject">
                            </div>
                        </li>
                        <li>
                            <div class="label_box">
                                <label for="content">내용</label>
                            </div>
                            <div class="input_box">
                                <textarea name="content" id="content"></textarea>
                            </div>
                        </li>
                    </ul>
                    <button type="button" class="send_btn" onclick="check_input();">메세지 보내기</button>
                </div>

            </form>
        </div>


    </section>


    <footer>
        <?php include "./footer.php" ?>
    </footer>


    <script src="./js/message.js"></script>
</body>
</html>