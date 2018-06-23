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
    
    $conn = db_connect();
    $query = "SELECT * FROM teams WHERE for_event='".$_SESSION['event_id']."' AND team_name='".$_POST['team_name']."'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $rowcount = mysqli_num_rows($result);
    mysqli_free_result($result);
    if($rowcount==0) {
        $query = "INSERT INTO teams(team_name, for_event) VALUES('".$_POST["team_name"]."', '".$_SESSION["event_id"]."')";
        mysqli_query($conn, $query);
        $query = "SELECT team_id FROM teams WHERE team_name='".$_POST["team_name"]."' AND for_event='".$_SESSION["event_id"]."'";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));;
        $var = mysqli_fetch_array($result);
        for($count = 0; $count< count($_POST['student_id']); $count++){
            $query = "INSERT INTO signs(event_id, team_id, student_id) VALUES('".$_SESSION['event_id']."',' ".$var['team_id']."','".$_POST['student_id'][$count]."')";
            mysqli_query($conn, $query) or die(mysqli_error($conn));;

        }
        mysqli_close($conn);
        header('location: ./event.php');
    }
    else{
        $_SESSION['message'] = "The name has been used by other team!";
        mysqli_close($conn);
        header('location: ./sign.php');
    }
?>