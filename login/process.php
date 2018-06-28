<?php
    session_start();
    include('/src/autoload.php');

    // parameters setup
   /* define(host, 'localhost');
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
*/
    $servername = "localhost";//連接伺服器
	$username = "root";
	$password = "123";
	$dbname = "final";//選擇欲讀取的資料庫名稱
	$conn = new mysqli($servername, $username, $password, $dbname);//create connection
    mysqli_query($conn, "SET NAMES 'UTF8'");
   

    $pwd = md5($_POST['password']);
    $id = $_POST['studentid'];
    $siteKey = '6LfF_GAUAAAAAFfYGBfsinBjf1pdiKkY_TBZLQwq';
    $secret = '6LfF_GAUAAAAAIotJgLfa60983blVIOeMYXCVoP8';

    
    if(isset($_POST['g-recaptcha-response'])){

// 建立一個命名空間
$recaptcha = new \ReCaptcha\ReCaptcha($secret);

// 將 recaptcha->verify 的值給 resp 變數
$resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

    if($resp->isSuccess() == true){
   
        $res = mysqli_query($conn, "SELECT * FROM user WHERE student_id='$id' AND password='$pwd'")
                or die("Failed to query database".mysql_error());
        //($conn);

        if($rows = mysqli_fetch_array($res)){
            $_SESSION['username'] = $rows['student_id'];
            header('location: ../index.php');
        }
        else{
            $_SESSION['message'] = "There's no corresponding account!";
            header('location: ./login.php');

        }
    }
}
?>