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


    $pwd = $_POST['password'];
    $id = $_POST['studentid'];
    //$_POST["password"] = md5($_POST["password"]);
    $conn = db_connect();
    //$query = "SELECT * FROM user WHERE student_id='".$id."' AND password='".$pwd."'";
    $res = mysqli_query($conn, "SELECT * FROM user WHERE student_id='$id' AND password='$pwd'")
            or die("Failed to query database".mysql_error());
    mysqli_close($conn);

    if($rows = mysqli_fetch_array($res)){
        $_SESSION['username'] = $rows['student_id'];
        header('location: ../index.php');
    }
    else{
        $_SESSION['message'] = "There's no corresponding account!";
        header('location: ./login.php');

    }
?>