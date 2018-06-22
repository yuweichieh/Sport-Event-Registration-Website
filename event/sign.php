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
	<link rel="stylesheet" type="text/css" href="../css/styles.css"/>
    <link rel="stylesheet" type="text/css" href="../css/index.css"/>
    <!--
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    -->
    <script src="jquery-3.3.1.min.js"></script>
    
</head>

<!-- ==================================== -->
<!-- Website Design -->
<body>
    
	<div class="header">
        <div class="container">
            <div class="logo">
                <h1><a href="#">NCTU SPORTS</a></h1>
            </div>
            
            <?php   if($_SESSION['username']==1){  ?>
            <ul class="_nav">
                <li><a href="../index.php">首頁</a></li>
                <li><a href="./event.php">活動報名</a></li>
                <li><a href="#">報名狀況</a></li>
                <li style="color:white;">Hi, Admin</li>
                <li><input type="button" value="登出" onclick="logout()"></li>
                <script type="text/javascript">
                    function logout(){
                        var conf = confirm("Do you want to logout?");
                        if(conf){
                            window.location.href = './login/logout.php';   
                        }
                    }
                </script>
            </ul>    
            
            <?php   }elseif(isset($_SESSION['username'])){  ?>
            <ul class="_nav">
                <li><a href="../index.php">首頁</a></li>
                <li><a href="./event">活動報名</a></li>
                <li style="color:white;">Hi, <?php echo $_SESSION['username']; ?></li>
                <li><input type="button" value="登出" onclick="logout()"></li>
                <script type="text/javascript">
                    function logout(){
                        var conf = confirm("Do you want to logout?");
                        if(conf){
                            window.location.href = './login/logout.php';   
                        }
                    }
                </script>
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
                $conn = db_connect();
                $query = "SELECT count(distinct(s.team_name))as total_teams, e.team_limit as team_limit FROM signs s, events e where s.event_id=".$_GET["event_id"]."AND e.event_id=".$_GET['event_id'];
                $result = mysqli_query($conn, $query);
                mysqli_close($conn);
                $var = mysqli_fetch_array($result);
                if($var['total_teams']>=$var['team_limit']){
                    mysqli_free_result($result);
                    $_SESSION['message'] = "Reach the team limit constraint !";
                    header('location: ../index.php');
                }
                else{
            ?>
                <!-- member information table design with html -->
            <?php
                mysqli_free_result($result);
            ?>

        </div>
    </div>	
</body>
</html>