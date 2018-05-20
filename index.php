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
	<title>Index</title>
	<link rel="stylesheet" type="text/css" href="./css/styles.css">
    <link rel="stylesheet" type="text/css" href="./css/index.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">

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
            <?php
            if(!isset($_SESSION['username'])){
            ?>
			<ul class="_nav">
				<li><a href="./index.php">首頁</a></li>
				<li><a href="./register/register.php">註冊</a></li>
				<li><a href="#">活動報名</a></li>
				<li><a href="./login/login.php">登入</a></li>
			</ul>
            <?php   }else{  ?>
            <ul class="_nav">
				<li><a href="./index.php">首頁</a></li>
				<li><a href="#">活動報名</a></li>
				<!--<li><a href="./login/logout.php">登出</a></li> class="btn btn-danger navbar-btn"-->
                <li><input type="button" value="登出" onclick=logout()></li>
                <script type="text/javascript">
                    function logout(){
                        var conf = confirm("Do you want to logout?");
                        if(conf){
                            window.location = "./login/logout.php";   
                        }
                    }
                </script>

			</ul>
            <?php   }   ?>
            <?php
                if(isset($_SESSION['message'])){
                    echo "<div id='error_msg'>".$_SESSION['message']."</div>";
                    unset($_SESSION['message']);
                }
            ?>
            <div class="ann_box">
                <?php
                    $conn = db_connect();
                    $query = "SELECT * FROM announces ORDER BY ann_id Desc LIMIT 7";
                    $result = mysqli_query($conn, $query);
                    mysqli_close($conn);
                ?>
                
                <h1>&nbsp&nbsp&nbsp最新公告</h1><br>
                <table width=100% border="0" cellpadding ="6" cellspacing="0">
                <?php
                    while ($var = mysqli_fetch_array($result)){
                ?>
                    <tr>
                        <th><?php echo $var['ann_date'] ?></th>
                        <td><?php echo $var['title'] ?></td>
                    </tr>
                <?php
                    }
                ?>
                </table>
                <?php
                    mysqli_free_result($result);
                ?>
                
            </div>
		</div>	
	</div>
</body>
</html>