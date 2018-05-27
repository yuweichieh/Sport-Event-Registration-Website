<?php
    include('registing.php');
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
	<meta charset="utf-8">
	<title>Regist</title>
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../css/register.css">
	<script></script>
</head>

<!-- ==================================== -->
<!-- Website Design -->
    <body>
        <div class="header">

            <div class="container">

                <div class="logo">
                    <h1><a href="#">NCTU SPORTS</a></h1>
                </div>

                <ul class="_nav">
                    <li><a href="../index.php">首頁</a></li>
                    <li><a href="./register.php">註冊</a></li>
                    <li><a href="../event/event.php">活動報名</a></li>
                    <li><a href="../login/login.php">登入</a></li>
                </ul>
            </div>	
        </div>
        
        <div class="container">
            <div class="regist_box">
                    <?php
                        if(isset($_SESSION['message'])){
                            echo "<div id='error_msg'>".$_SESSION['message']."</div>";
                            unset($_SESSION['message']);
                        }
                    ?>      
                    <form action="./register.php" method="post">
                    <b>學號</b><br>
                    <input type="number" name="studentid" placeholder="Enter your Student ID" required><br>
                    <b>信箱</b><br>
                    <input type="text" name="email" placeholder="Enter your E-mail" required><br>
                    <b>密碼</b><br>
                    <input type="password" name="password" placeholder="Enter your password" required><br>
                    <b>確認密碼</b><br>
                    <input type="password" name="password_chk" placeholder="Enter your password again" required><br>
                    <!-- 驗證碼未完成 -->
                    <b>驗證碼</b><br>
                    <input type="QQ" name="QQ" placeholder="Calculate the answer of following image"><br>
                    <input type="submit" name="regist" value="註冊">
                    <input type="reset" value="取消">
                </form>
            </div>
        </div>
        


    </body>
</html>