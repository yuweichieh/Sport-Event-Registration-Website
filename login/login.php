
<!DOCTYPE html>
<html lang="zh-TW">
<head>
	<meta charset="utf-8">
	<title>Regist</title>
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../css/login.css">
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
                <ul class="nav">
                    <li><a href="../index.php">首頁</a></li>
                    <li><a href="../register/register.php">註冊</a></li>
                    <li><a href="#">活動報名</a></li>
                    <li><a href="./login.php">登入</a></li>
                </ul>
            </div>	
        </div>
        
        <div class="container">
            <div class="login_box">
                <form action="./register.php" method="post">
                    <b>學號</b><br>
                    <input type="number" name="studentid" placeholder="Enter your Student ID"><br>
                    <b>密碼</b><br>
                    <input type="password" name="password" placeholder="Enter your password"><br>
                    <input type="submit" name="submit" value="Login"> 
                </form>
            </div>
        </div>
        


    </body>
</html>