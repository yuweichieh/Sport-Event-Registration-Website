<?php
    session_start();
    // parameters setup
    define(host, 'localhost');
    define(user, 'root');
    define(password, 'root');
    define(db_name, 'my_db');
    define(port, 8889);

    function db_connect(){
        // create connection to database
        $conn = mysqli_connect(host, user, password, db_name, port);
        if($conn->connect_error)
            die("Connection failed: ". $conn->connect_error);
        return $conn;
    }
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
	<meta charset="utf-8">
	<title>Login</title>
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
                <ul class="_nav">
                    <li><a href="../index.php">首頁</a></li>
                    <li><a href="../register/register.php">註冊</a></li>
                    <li><a href="#">活動報名</a></li>
                    <li><a href="./login.php">登入</a></li>
                </ul>
            </div>	
        </div>
        
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
                    <input type="submit" name="login_btn" value="Login" /> 
                </form>
            </div>
        </div>
        <!--
        
        <?php
            if(isset($_POST['login_btn'])){
                $pwd = $_POST['password'];
                $id = $_POST['studentid'];
                //$_POST["password"] = md5($_POST["password"]);
                $conn = db_connect();
                //$query = "SELECT * FROM user WHERE student_id='".$id."' AND password='".$pwd."'";
                $res = mysqli_query($conn, "SELECT * FROM user WHERE student_id='$id' AND password='$pwd'")
                        or die("Failed to query database".mysql_error());
                mysqli_close($conn);
                
                if($rows = mysqli_fetch_array($res)){
                    $_SESSION["username"] = $rows["username"];
                    header('location: ../index.php');
                }
                else{
                    $_SESSION['message'] = "There's no corresponding account!";
                    header('location: ../register/register.php');

                }
            }
        ?>
        -->
    </body>
</html>