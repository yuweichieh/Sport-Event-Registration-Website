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
	<link rel="stylesheet" type="text/css" href="../css/styles.css"/>
    <link rel="stylesheet" type="text/css" href="../css/anncs.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
                $query = "SELECT count(distinct(s.team_name))as total_teams, e.team_limit as team_limit FROM signs s, events e where s.event_id=".$_GET['event_id']."AND e.event_id=".$_GET['event_id'];
                $result = mysqli_query($conn, $query);
                mysqli_close($conn);
                $var = mysqli_fetch_array($result); 
                mysqli_free_result($result);
               /* if($var['total_teams']>=$var['team_limit']){
                    $_SESSION['message'] = "Reach the team limit constraint !";
                    header('location: ../index.php');
                }
                else*/
                {
            ?>
                <!-- member information form design with html -->
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