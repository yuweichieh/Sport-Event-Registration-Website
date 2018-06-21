<?php
    session_start();
    // parameters setup
    define(host, 'localhost');
    define(user, 'root');
    define(password, 'root');
    define(db_name, 'my_db');
    define(port, 8889);
        //var_dump($_GET["ann_id"]);
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
	<title>New Announcement</title>
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
	<link rel="stylesheet" type="text/css" href="../css/anncs.css">
    <link rel="stylesheet" type="text/css" href="../css/index.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">    
</head>

<!-- ==================================== -->
<!-- Website Design -->
<body>
    
	<div class="header">
        
		<div class="container">

			<div class="logo">
                <h1><a href="#">NCTU SPORTS</a></h1>
			</div>
            <?php
            if(!isset($_SESSION['username'])){
            ?>
			<ul class="_nav">
				<li><a href="../index.php">首頁</a></li>
				<li><a href="../register/register.php">註冊</a></li>
				<li><a href="#">活動報名</a></li>
				<li><a href="../login/login.php">登入</a></li>
			</ul>
            <?php   }else{  ?>
            <ul class="_nav">
				<li><a href="../index.php">首頁</a></li>
				<li><a href="#">活動報名</a></li>
				<!--<li><a href="./login/logout.php">登出</a></li> class="btn btn-danger navbar-btn"-->
                <li><input type="button" value="登出" onclick="logout()"></li>
               
			</ul>
            
            <?php   }   ?>
        </div>
    </div>
    
            
    <div class="container">
        <div class="add_box">
            <?php
                if(isset($_SESSION['message'])){
                    echo "<div id='error_msg'>".$_SESSION['message']."</div>";
                    unset($_SESSION['message']);
                }
            ?>      
            <form action="./event_create.php" method="post" id="ann">
                <font size="16">活動名稱</font><br>
                <input class="title" type="text" name="title" required><br>
                <font size="16">活動規則</font><br>
                <!--<input class="content" type="text" name="content" required><br>-->
                <textarea class="rule" cols="50" name="rule" required></textarea><br>
                <font size="16">隊伍限制</font><br>
                <input class="title" type="number" name="team_limit" required><br>
                <font size="16">人數限制</font><br>
                <input class="title" type="number" name="mem_limit" required><br>
                <input type="submit" name="ann_post" value="發佈公告">
                <input type="reset" value="取消">
            </form>
        </div>
	</div>

</body>
</html>