<?php
    session_start();
    include('/src/autoload.php');

    // parameters setup
   /* define(host, 'localhost');
    define(user, 'root');
    define(password, '123');
    define(db_name, 'final');
    //define(port, 8889);

    function db_connect(){
        // create connection to database
        $conn = mysqli_connect(host, user, password, db_name, port);
        if($conn->connect_error)
            die("Connection failed: ". $conn->connect_error);
        return $conn;
    }*/
    $servername = "localhost";//連接伺服器
	$username = "root";
	$password = "123";
	$dbname = "final";//選擇欲讀取的資料庫名稱
	$conn = new mysqli($servername, $username, $password, $dbname);//create connection
    mysqli_query($conn, "SET NAMES 'UTF8'");

    $siteKey = '6LfF_GAUAAAAAFfYGBfsinBjf1pdiKkY_TBZLQwq';
    $secret = '6LfF_GAUAAAAAIotJgLfa60983blVIOeMYXCVoP8';

    // 初始化變數為空值
    $resp = '';
   

?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
	<meta charset="utf-8">
	<title>Login</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl=<?php echo $lang; ?>" async defer></script>

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
                    <li><a href="../register/register.php">註冊</a></li>
                    <li><a href="../event/event.php">活動報名</a></li>
                    <li><a href="./login.php">登入</a></li>
                </ul>
            </div>	
        </div>
        <?php

// 判斷提交過來的 g-recaptcha-response 參數，是否存在
/*if(isset($_POST['g-recaptcha-response']))
{

// 建立一個命名空間
$recaptcha = new \ReCaptcha\ReCaptcha($secret);

// 將 recaptcha->verify 的值給 resp 變數
$resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);


     // 判斷 resp->isSuccess 是 true 或 false
     if($resp->isSuccess() == true)
	 {

         echo '<p><strong><font color="blue">恭喜，通過 reCAPTCHA 驗證碼！</font></strong></p>';

		 // 此處請自行舉一反三，通過 reCAPTCHA 驗證後，接下來是將提交過來的帳號和密碼，與 mysql 資料庫內的會員帳號和密碼，做比對
		 // 假設 mysql 資料庫內，有一筆資料，帳號是 test01 密碼是 test01test01
		 if(($_POST['studentid'] == '$id') && ($_POST['password'] == '123'))
		 {
			 echo '<p><strong><font color="blue">恭喜，輸入的帳號和密碼正確！</font></strong></p>';
             echo '<p><a href="t55.php">點此到 t55.php</a></p>';
			 exit();
		 }
		 else
		 {
			 echo '<p><strong><font color="red">錯誤，輸入的帳號和密碼不正確！</font></strong></p>';
		 }


     }
	 else
	 {

         echo '<p><strong><font color="red">錯誤，不能通過 reCAPTCHA 驗證碼！</font></strong></p>';

		 //顯示 reCAPTCHA 錯誤訊息，可有可無
		 foreach($resp->getErrorCodes() as $error_code)
		 {
                echo '<p>' . $error_code . '</p>';
         }

     }
}*/

?>

        
        <div class="container">
            <div class="login_box">
                <?php
                    if(isset($_SESSION['message'])){
                        echo "<div id='error_msg'>".$_SESSION['message']."</div>";
                        unset($_SESSION['message']);
                    }
                ?>
                <form action="./process.php" method="post">
                    <b>學號</b><br>
                    <input type="number" name="studentid" placeholder="Enter your Student ID" /><br>
                    <b>密碼</b><br>
                    <input type="password" name="password" placeholder="Enter your password" /><br>
                    
                    <div class="g-recaptcha" data-sitekey="<?php echo $siteKey; ?>"></div>
                    <br><br>
                    <input type="submit" name="login_btn" value="Login" /> 

                </form>
            </div>
        </div>
    </body>
</html>