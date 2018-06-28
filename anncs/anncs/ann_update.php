<?php

session_start();
$title1="";
$content1="";
$image1="";

// connect to the database
$db = mysqli_connect('localhost', 'root', '123', 'final');

// 按下按鈕(提交表單)
if(isset($_GET['ann_id'])){
    $query = "SELECT * FROM announces WHERE ann_id=".$_GET["ann_id"];
    $result = mysqli_query($conn, $query);
    //mysqli_close($conn);
    $var = mysqli_fetch_array($result);
}
    
if (isset($_POST['UPDATE'])) {

	$title =$_POST['title1'];
	if(isset($content1)){  
		$content1 = $_POST['content1'];
		$query="UPDATE announces SET content='$content1' WHERE title='$title'";
    }

  	$filename=$_FILES['image1']['name'];
	$tmpname=$_FILES['image1']['tmp_name'];
	$filetype=$_FILES['image1']['type'];
	$filesize=$_FILES['image1']['size'];
	$file=NULL;

	
	if(isset($_FILES['image1']['error'])){
		if($_FILES['image1']['error']==0){
			$instr = fopen($tmpname,"rb" );
			$file = addslashes(fread($instr,filesize($tmpname)));
		}
	}
	

  $user_check_query = "SELECT * FROM announces WHERE 1";
  mysqli_query($db, "SET NAMES utf8");
  $imagedata = sprintf("(%s)","'".$file."'");
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);


   
    mysqli_query($db, $query);
    $_SESSION['message'] = "Announcement updated!";
    //mysqli_close($conn);
    header('location: ../index.php');
	;


 }
?>

<?php
    session_start();
    $conn = new mysqli('localhost', 'root', 'root', 'my_db', 8889);
    if($conn->connect_error)
        die("Connection failed: ". $conn->connect_error);
    $title = $_POST['title'];
    $content = $_POST['content'];

    $filename=$_FILES['image']['name'];
	$tmpname=$_FILES['image']['tmp_name'];
	$filetype=$_FILES['image']['type'];
	$filesize=$_FILES['image']['size'];
    $file=NULL;

    $imagedata = sprintf("(%s)","'".$file."'");
    
    $query = "UPDATE announces SET title = '$title', content = '$content', ann_pic = '$imagedata' WHERE ann_id=".$_SESSION['ann_id'];
    //$query = "INSERT INTO announces(title, content) VALUES('$title', '$content')";
    unset($_SESSION['ann_id']);;
    mysqli_query($conn, $query) or die(mysqli_error($conn));
    $_SESSION['message'] = "Announcement updated!";
    mysqli_close($conn);
    header('location: ../index.php');
?>
