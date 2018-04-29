<?php
    include('registing.php');
/*    session_start();
    $_SESSION['message'] = '';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($_POST['password'] == $_POST['passwork_chk']){
            $conn = mysqli_connect('localhost', 'root', 'root', 'final');
                    if($conn->connect_error)
                        die("Connection failed: ". $conn->connect_error);
            $studentid = $conn->real_escape_string($_POST['studentid']);
            $email = $conn->real_escape_string($_POST['email']);
            $password = md5($_POST['password']);
            
            $query = "INSERT INTO user(student_id, password, email) VALUES('$studentid', '$password', '$email')"
            if($conn->query($query) === true){
                $_SESSION['username'] = $studentid;
                $_SESSION['message'] = "Resgistration success!";
                header("location: ../index.php");
            }
            else{
                $_SESSION['message'] = "Registration failed while being inserted to database QAQ";
            }
        }
        else{
            $_SESSION['message'] = "The two passwords don't match!"
        }
    }*/
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

                <ul class="nav">
                    <li><a href="../index.php">首頁</a></li>
                    <li><a href="./register.php">註冊</a></li>
                    <li><a href="#">活動報名</a></li>
                    <li><a href="../login/login.php">登入</a></li>
                </ul>
            </div>	
        </div>
        
        <div class="container">
            <div class="regist_box">
                <div class="error"><A style="color:red; font-size:120%;"><?= $_SESSION['message'] ?></A></div>
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