<?php
    session_start();
    if (isset($_POST['regist'])){
        $conn = new mysqli('localhost', 'root', 'root', 'my_db', 8889);
        if($conn->connect_error)
            die("Connection failed: ". $conn->connect_error);
        $studentid = $_POST['studentid'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_chk = $_POST['password_chk'];
        $name = $_POST['name'];
        /*
        $studentid = mysqli_real_escape_string($_POST['studentid']);
        $email = mysqli_real_escape_string($_POST['email']);
        $password = mysqli_real_escape_string($_POST['password']);
        $password_chk = mysqli_real_escape_string($_POST['password_chk']);
        */
        $query = "select * from user where student_id=".$studentid;
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
        
        if($password != $password_chk){            
            $_SESSION['message'] = "The two passwords don't match!";
            mysqli_close($conn);
            header('location: ./register.php');
        }
        elseif(mysqli_num_rows($result)==1){
            $_SESSION['message'] = "You have already regist an account!";
            header('location: ./register.php');
        }
        else{   // input datas got nothing wrong
            $password = md5($password);
            $query = "INSERT INTO user(student_id, password, email, name) VALUES('$studentid', '$password', '$email', '$name')";
            mysqli_query($conn, $query) or die(mysqli_error($conn));
            $_SESSION['username'] = $studentid;
            mysqli_close($conn);
            header('location: ../index.php');
        }
        
    }
?>
