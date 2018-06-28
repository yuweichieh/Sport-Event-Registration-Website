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
    $query = "DELETE FROM announces WHERE ann_id=".$_GET["ann_id"];
    $result = mysqli_query($conn, $query);

    if ($result) {
        $_SESSION['message'] = "The announcement has been successfully deleted!";
    }
    else {
        $_SESSION['message'] = "Fail while deleting announcement T_T.";
    }
    mysqli_close($conn);

    header('location: ../index.php');
?>