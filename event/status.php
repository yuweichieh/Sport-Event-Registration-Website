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
	<title>Event</title>
	<link rel="stylesheet" type="text/css" href="../css/styles.css"/>
	<link rel="stylesheet" type="text/css" href="../css/status.css"/>
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
            
            <ul class="_nav">
                <li><a href="../index.php">首頁</a></li>
                <li><a href="./event.php">活動報名</a></li>
                <li><a href="./status.php">報名狀況</a></li>
                <li style="color:white;">Hi, Admin</li>
                <li><input type="button" value="登出" onclick="logout()"></li>
                <script type="text/javascript">
                    function logout(){
                        var conf = confirm("Do you want to logout?");
                        if(conf){
                            window.location.href = '../login/logout.php';   
                        }
                    }
                </script>
            </ul> 
        </div>
	</div>

    <div class="container">
        <div class="ann_box">
            <?php
                if(isset($_SESSION['message'])){
                    echo "<div id='error_msg'>".$_SESSION['message']."</div>";
                    unset($_SESSION['message']);
                }
                $conn = db_connect();
                $query = "SELECT * FROM events";
                $result = mysqli_query($conn, $query);
                mysqli_close($conn);
            ?>

            <h1>&nbsp;&nbsp;&nbsp;報名狀況</h1>
            
            <table width=100% border="0" cellpadding ="6" cellspacing="0">
            <?php
                while ($var = mysqli_fetch_array($result)){
            ?>
                    <tr><th width=40%><?php echo $var['name'] ?></th></tr>
            <?php
                    $conn = db_connect();
                    $query = "select * from teams where for_event=".$var['event_id'];
                    $result2 = mysqli_query($conn, $query);
                    if(mysqli_num_rows($result2)==0){
            ?>
                        <tr><td>尚無報名資料</td></tr>
            <?php
                        mysqli_close($conn);
                    }
                    else{
            ?>
                    <tr><td width=50%><a>隊伍名稱</a></td><td width=50%><a>隊伍成員</a></td></tr>

            <?php
                        while($var2 = mysqli_fetch_array($result2)){    
            ?>
                            <tr><td width=50%><?php echo $var2['team_name'] ?></td>
                            <?php
                                $query = "select * from signs where team_id=".$var2['team_id'];
                                $result3 = mysqli_query($conn, $query);
                                $i=0;
                                while($var3 = mysqli_fetch_array($result3)){
                                    $query = "select * from user where student_id=".$var3['student_id'];
                                    $result4 = mysqli_query($conn, $query);
                                    $var4 = mysqli_fetch_array($result4);
                                    if($i==0){
                                        $i++;
                            ?>
                                        <td width=50%><?php echo $var3['student_id']." ".$var4['name']?></td></tr>
                            <?php
                                    }else{
                            ?>
                                        <tr><td width=50%> </td><td width=50%><?php echo $var3['student_id']." ".$var4['name']?></td></tr>
                            <?php            
                                    }
                                }
                        }
                    }
                }
            ?>
            </table>
            <?php
                mysqli_free_result($result);
            ?>

        </div>
    </div>	
</body>
</html>