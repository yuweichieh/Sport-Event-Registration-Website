<?php
    session_start();
    // parameters setup
    define(host, 'localhost');
    define(user, 'root');
    define(password, 'root');
    define(db_name, 'my_db');
    define(port, 8889);
    $_SESSION['event_id'] = $_GET['event_id'];
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	
    <link rel="stylesheet" type="text/css" href="../css/anncs.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/styles.css"/>
 <!--   <script src="jquery-3.3.1.min.js"></script> -->
    
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
                            window.location.href = '../login/logout.php';   
                        }
                    }
                </script>
            </ul>    
            
            <?php   }elseif(isset($_SESSION['username'])){  ?>
            <ul class="_nav">
                <li><a href="../index.php">首頁</a></li>
                <li><a href="./event.php">活動報名</a></li>
                <li style="color:white;">Hi, <?php echo $_SESSION['username']; ?></li>
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
                // finding signed teams and team limit
                $query = "SELECT count(distinct(s.team_name))as total_teams, e.mem_limit as mem_limit, e.team_limit as team_limit FROM teams s, events e where e.event_id=".$_GET['event_id']." AND s.for_event=".$_GET['event_id'];
                $result = mysqli_query($conn, $query);
                // check if this user has signed
                $query = "select team_id from signs where event_id=".$_GET['event_id']." and student_id=".$_SESSION['username'];
                $check = mysqli_query($conn, $query);
                mysqli_close($conn);
                $var = mysqli_fetch_array($result); 
                mysqli_free_result($result);
                // the user has already sign in for this event
                // then give the signed team's information and delete button
                if(mysqli_num_rows($check)!=0){
                    $conn = db_connect();
                    $team_id = mysqli_fetch_array($check);
                    // find all user in this team
                    $query = "select student_id from signs where team_id=".$team_id['team_id'];
                    $result = mysqli_query($conn, $query);
                    // get team name
                    $query = "select team_name from teams where team_id=".$team_id['team_id'];
                    $result2 = mysqli_query($conn, $query);
                    $team_name = mysqli_fetch_array($result2);
                    
            ?>
                <table width=80% border="0" cellpadding ="6" cellspacing="0">                    
                    <h1><?php echo $team_name['team_name'] ?></h1>
                    <th width=40%><h3>學號</h3></th><th width=40%><h3>姓名</h3></th>
            <?php   
                while ($var = mysqli_fetch_array($result)){
                    
            ?>
                <tr>
                    <td><h4><?php echo $var['student_id']; ?></h4></td>
                    <td><h4><?php
                    $conn2 = db_connect();
                    $query = "select user_id from user where student_id=123";
                    $_reuslt = mysqli_query($conn, $query);
                    $name = mysqli_fetch_array($_result);
                    echo $name['user_id']; ?></h4></td>
                    
                </tr>
            <?php
                }
            ?>
                    </table>
                <center><a href="./sign_delete.php?event_id=<?php echo $_GET['event_id']."&team_id=".$team_id['team_id']?>" class="delete_btn">取消報名</a></center>
            <?php
                    mysqli_close($conn);
                }
                // the event has reached the total team limit
                elseif($var['total_teams']>=$var['team_limit']){
                    $_SESSION['message'] = "Reach the team limit constraint !";
                    header('location: ./event.php');
                }
                else
                {
            ?>
                <!-- member information form design with html -->
                <br />
                <h5>每隊上限： <?php echo $var['mem_limit']?>人</h5>
                <h5>隊伍上限： <?php echo $var['team_limit']?>隊</h5>
                <h5>已報名隊伍： <?php echo $var['total_teams']?>隊</h5>
                <a style="color:red">尚可報名： <?php echo ($var['team_limit']-$var['total_teams'])?>隊</a>
                <h3 align="center">隊員名單</h3><br />
                <form action="./insert_data.php" method="post" id="insert_form">
                    <div class="table-repsonsive">
                        <span id="error"></span>
                        <table class="table table-bordered" id="item_table">
                            <tr><th>隊伍名稱</th></tr>
                            <tr>
                            <th><input type="text" name="team_name" class="form-control team_name" /></th></tr>
                            <tr>
                            <th width=40%>Student ID</th>
                                <th width=20%><center><button type="button" name="add" id="add" class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span></button></center></th></tr>
                            <tr>
                            <td><input type="number" name="student_id[]" class="form-control student_id" /></td>
                                <td><center><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></center></td></tr>
                        </table>
                        <br />
                        <div align="center">
                            <input type="submit" name="submit" class="btn btn-info" value="確認報名" />
                        </div>
                    </div>
                </form>             
            <?php   }   ?>
        </div>
    </div>	    
</body>
</html>

<script>
$(document).ready(function(){
    $(document).on('click', '.add', function(){
    //$('#add').click(function(){
    
       var html_code = '';
       html_code += '<tr>';
       html_code += '<td><input type="number" name="student_id[]" class="form-control student_id" /></td>';
       html_code += '<td><center><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></center></td></tr>';
       
       //$('#item_table').append(html_code);
       
        $('#item_table tr:last').after(html_code);
    });

    $(document).on('click', '.remove', function(){
       $(this).closest('tr').remove(); 
    });
});
</script>