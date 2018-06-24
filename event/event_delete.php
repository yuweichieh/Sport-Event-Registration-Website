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

    $conn = new mysqli('localhost', 'root', 'root', 'my_db', 8889);
        if($conn->connect_error)
            die("Connection failed: ". $conn->connect_error);
    // delete regist teams for this event
    $query1 = "DELETE FROM teams WHERE for_event=".$_GET["event_id"];
    $result1 = mysqli_query($conn, $query1);
    // also deleter signs record for this event
    $query2 = "DELETE FROM signs WHERE event_id=".$_GET["event_id"];
    $result2 = mysqli_query($conn, $query2);
    // then delete this event
    $query = "DELETE FROM events WHERE event_id=".$_GET["event_id"];
    $result = mysqli_query($conn, $query);

    if ($result) {
        $_SESSION['message'] = "The event has been successfully deleted!";
    }
    else {
        $_SESSION['message'] = "Fail while deleting event T_T.";
    }
    mysqli_close($conn);

    header('location: ../index.php');
?>