<?php
    session_start();
    //$errors = array();


    if (isset($_POST['regist'])){
        $conn = new mysqli('localhost', 'root', 'root', 'my_db', 8889);
        if($conn->connect_error)
            die("Connection failed: ". $conn->connect_error);

        $studentid = $_POST['studentid'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_chk = $_POST['password_chk'];
        /*
        $studentid = mysqli_real_escape_string($_POST['studentid']);
        $email = mysqli_real_escape_string($_POST['email']);
        $password = mysqli_real_escape_string($_POST['password']);
        $password_chk = mysqli_real_escape_string($_POST['password_chk']);
        */
        if($password != $password_chk){            
            $_SESSION['message'] = "The two passwords don't match!";
            header('location: ./register.php');
        }
        else{   // input datas got nothing wrong
            $password = md5($password);
            $query = "INSERT INTO user(student_id, password, email) VALUES('$studentid', '$password', '$email')";
            mysqli_query($conn, $query) or die(mysqli_error($conn));
            $_SESSION['username'] = $studentid;
            header('location: ../index.php');
        }
        mysqli_close($conn);
        
    }

?>