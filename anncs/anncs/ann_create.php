<?php
    session_start();
    $conn = new mysqli('localhost', 'root', '123', 'final');
    if($conn->connect_error)
        die("Connection failed: ". $conn->connect_error);

if (isset($_POST)) {
    $title = $_POST['title'];
    $content = $_POST['content'];


    $filename=$_FILES['image']['name'];
    $tmpname=$_FILES['image']['tmp_name'];
    $filetype=$_FILES['image']['type'];
    $filesize=$_FILES['image']['size'];    
    $file=NULL;
    
    if(isset($_FILES['image']['error'])){    
        if($_FILES['image']['error']==0){                                    
            $instr = fopen($tmpname,"rb" );
            $file = addslashes(fread($instr,filesize($tmpname)));        
        }
    }	
    $conn = new mysqli('localhost', 'root', '123', 'final');
    mysqli_query($conn, "SET NAMES 'UTF8'");
    $imagedata = sprintf("(%s)","'".$file."'");
    
    $sql = "INSERT INTO announces(title, content, ann_pic) VALUES('$title', '$content','$imagedata')";
    $conn->query($sql);   


    $_SESSION['message'] = "New announcement added!";
    //mysqli_close($conn);
    header('location: ../index.php');
    }
?>