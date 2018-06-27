<?php
include('registing.php');

//error_reporting(E_ALL); //除錯用

if(!isset($_SESSION)){ session_start(); }  //判斷session是否已啟動

$ans_str=0; $ans_now='';  //變數初始化

//判斷ans_ckword及anscheck這2者是否為空，如不為空是否等於
if((!empty($_SESSION['ans_ckword'])) && (!empty($_POST['anscheck'])) && ($_SESSION['ans_ckword'] == $_POST['anscheck'])){

	 $_SESSION['ans_ckword'] = ''; //通過後，清空ans_ckword值

	 header('content-Type: text/html; charset=utf-8');  //強符集utf-8

	 echo '<p>&nbsp;</p><p>&nbsp;</p><a href="./register.php">驗證成功</a>';

	 exit();

}else{  //不通過則執行

     $_SESSION['ans_ckword'] = '';
     echo "<script>alert('驗證碼錯誤')</script>";

     mt_srand((double)microtime() * 1000000);  //重置隨機值

     //隨機取得6個小寫英字a-z
     for($i=0; $i<6; $i++){
         $ans_str = mt_rand(97,122);
         $ans_now .= chr($ans_str);
     }
     

     $_SESSION['ans_ckword'] = $ans_now;  //將值放至session

}

?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html lang="zh-TW">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Regist</title>
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../css/register.css">
	<script type="text/javascript">
    function zbk(Idn2){ if(document.getElementById){ return document.getElementById(Idn2); }else if(document.all){ return document.all(Idn2); }else{ return false; } }
    function zcheckimg(){ zbk("idshowpic").innerHTML="<img src=./showpic.php>"; }
    </script>
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
                    <b>姓名</b><br>
                    <input type="text" name="name" placeholder="Enter your Name" required><br>
                    <b>信箱</b><br>
                    <input type="text" name="email" placeholder="Enter your E-mail" required><br>
                    <b>密碼</b><br>
                    <input type="password" name="password" placeholder="Enter your password" required><br>
                    <b>確認密碼</b><br>
                    <input type="password" name="password_chk" placeholder="Enter your password again" required><br>
                    <!-- 驗證碼未完成 -->
                    <b>點擊下框，可見驗證碼</b><br>
                    <p><div id="idshowpic" name="idshowpic"></div></p>
                    <input type="text" name="anscheck" size="10" maxlength="10" value="" onfocus="zcheckimg();">
                    <input type="submit" name="regist" value="註冊">
                    <input type="reset" value="取消">
                </form>
            </div>
        </div>
        


    </body>
</html>