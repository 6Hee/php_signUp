<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>프로그램 등록</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/products.css">
</head>
<body>

    <header>
        <?php include "./header.php"?>
    </header>

    <section>
        <div id="product_box">
            <h2 id="product_title">프로그램 > 등록하기</h2>
            <form name="product_form" action="./products_insert.php" method="post" enctype="multipart/form-data">
                <ul id="product_form">
                    <li>
                        <div class="label_box">
                            <label for="">이름</label>
                        </div>
                        <div class="input_box">
                            <p><?=$username?>(<?=$userid?>)</p>
                        </div>
                    </li>
                    <li>
                        <div class="label_box">
                            <label for="tit">타이틀</label>
                        </div>
                        <div class="input_box">
                            <input type="text" name="title" id="tit">
                        </div>
                    </li>
                    <li>
                        <div class="label_box">
                            <label for="sub">서브 타이틀</label>
                        </div>
                        <div class="input_box">
                            <input type="text" name="sub" id="sub">
                        </div>
                    </li>
                    <li>
                        <div class="label_box">
                            <label for="cont">상세내용</label>
                        </div>
                        <div class="input_box">
                            <textarea name="content" id="cont"></textarea>
                        </div>
                    </li>
                    <li>
                        <div class="label_box">
                            <label for="price">가격(원/시간)</label>
                        </div>
                        <div class="input_box">
                            <input type="number" name="price" id="price">
                        </div>
                    </li>
                    <li>
                        <div class="label_box">
                            <label for="upload">대표 이미지</label>
                        </div>
                        <div class="input_box">
                            <input type="file" name="upfile" id="upload">
                        </div>
                    </li>
                </ul>
                <ul class="buttons">
                    <li><button type="button" onclick="check_input();">등록하기</button></li>
                    <li><button type="button" onclick="location.href='./products_list.php'">목록</button></li>
                </ul>
            </form>
        </div>
    </section>


    <footer>
        <?php include "./footer.php"?>
    </footer>

    <script src="./js/products.js"></script>

</body>
</html>