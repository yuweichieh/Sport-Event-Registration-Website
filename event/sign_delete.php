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

    $conn = db_connect();
    //echo $_GET['team_id'];
    //echo $_GET['event_id'];
    $query2 = "DELETE FROM signs WHERE event_id=".$_GET["event_id"]." AND team_id=".$_GET['team_id'];
    $result2 = mysqli_query($conn, $query2) or die;
    mysqli_close($conn);

    header('location: ../index.php');
?>