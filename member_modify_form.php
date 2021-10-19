<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OClass - 회원정보수정</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/member.css">
</head>
<body>
    
    <header>
        <?php include "./header.php" ?>
    </header>
    <!--session storage에 아이디, 네임, 레벨, 포인트를 이미 알고 있다.-->

    
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
    //$userid의 값이 존재
    include "./db_con.php";

    $sql = "select * from members where id='$userid'";
    $result = mysqli_query($con, $sql);
    //var_dump($result);
    $row = mysqli_fetch_array($result);
    //var_dump($row);
    $pass = $row["pass"];
    $name = $row["name"];

    //var_dump($pass);
    //var_dump($name);

    //이메일 abc@gmail.com => abc, gmail.com
    //explode("특정문자" , 문자열을 포함한 변수명 또는 대상) : 특정문자를 기준으로 분리시켜서 배열로 저장

    $email = explode("@", $row["email"]);
    //var_dump($email);

    $email1 = $email[0];
    $email2 = $email[1];

    mysqli_close($con); //접속종료



?>
        <div id="main_content">
            <div id="join_box">
                <form name="member_form" action="./member_modify.php?id=<?=$userid?>" method="post">
                    <h2>회원정보수정</h2>

                    <div class="form">
                        <div class="label_box">
                            <label for="userid">아이디</label>
                        </div>
                        <div class="input_box">
                            <input type="text" name="id" id="userid" value="<?=$userid?>" readonly>
                        </div>
                    
                    </div>

                    <div class="form">
                        <div class="label_box">
                            <label for="userpass">비밀번호</label>
                        </div>
                        <div class="input_box">
                            <input type="password" name="pass" id="userpass">
                        </div>
                    </div>

                    <div class="form">
                        <div class="label_box">
                            <label for="userpass_confirm">비밀번호 확인</label>
                        </div>
                        <div class="input_box">
                            <input type="password" name="pass_confirm" id="userpass_confirm">
                        </div>
                    </div>

                    <div class="form">
                        <div class="label_box">
                            <label for="username">이름</label>
                        </div>
                        <div class="input_box">
                            <input type="text" name="name" id="username" value="<?=$username?>">
                        </div>
                    </div>

                    <div class="form">
                        <div class="label_box">
                            <label for="useremail">이메일</label>
                        </div>
                        <div class="input_box email_input">
                            <input type="text" name="email1" value="<?=$email1?>">
                            <span>@</span>
                            <input type="text" name="email2" value="<?=$email2?>">
                        </div>
                    </div>

                    <div class="buttons">
                        <button type="button" onclick="check_input();">정보수정</button>
                        <button type="button" onclick="reset_form_modify();">취소하기</button>
                    </div>
                    <!--
                        <button type="button">일반버튼</button>
                        <button type="submit">전송버튼</button>
                        <button type="reset">초기화버튼</button>
                        
                        type="button" : 작동 조정이 가능 => javascript로 연동 가능
                        type="submit" : 작동 조정이 불가능. 직접 form 태그 action 내부의 주소로 접근 => javascript로 연동 불가능

                        javascript를 통한 입력 값에 대한 유효성 검사를 하고자 할 때는 type="submit"은 반드시 피할 것
                    -->
                </form>
            </div>
        </div>
    </section>

    <footer>
        <?php include "./footer.php" ?>
    </footer>





    <script src="./js/member_form.js"></script>
</body>
</html>