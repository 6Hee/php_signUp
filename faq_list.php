<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OClass - FAQ 리스트</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/faq.css">
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
<?php
    if(isset($_GET["listNum"])){
        $listNum = $_GET["listNum"];
    }else{
        $listNum = "";
    }

?>
        <div id="faq_box">
            <h2>FAQ > 리스트</h2>
            <div class="faq_list" data-listNum="<?=$listNum?>">
<?php
    include "./db_con.php";
    $sql = "select * from faq order by num";
    $result = mysqli_query($con, $sql);
    while($row = mysqli_fetch_array($result)){
        $subject = $row["subject"];
        $content = $row["content"];
?>
                <div class="list_detail">
                    <div class="question">
                        <h3><?=$subject?></h3>
                        <span>＋</span>
                    </div>
                    <div class="answer">
                        <p><?=$content?></p>
                    </div>
                </div>
<?php
    }
?>             

            </div>
<?php
    //관리자만 등록을 허용시킨다.
    if($userlevel == 1){
?>
            <ul class="buttons">
                <li><button type="button" onclick="location.href='./faq_form.php'">FAQ 등록</button></li>
            </ul>
<?php
    }
?>
        </div>
    </section>
    <footer>
        <?php include "./footer.php"?>
    </footer>
    <script src="./js/faq_list.js"></script>
    
</body>
</html>    