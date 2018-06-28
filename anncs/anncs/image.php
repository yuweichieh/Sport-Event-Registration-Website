<?php

    //從資料庫取得圖片
  $servername = "localhost";//連接伺服器
	$username = "root";
	$password = "123";
	$dbname = "final";//選擇欲讀取的資料庫名稱

	$conn = new mysqli($servername, $username, $password, $dbname);//create connection
	mysqli_query($conn, "SET NAMES 'UTF8'");

	if(isset($_GET['ann_id'])){
		$sql=sprintf("select * from announces where ann_id=". $_GET['ann_id']);
		$result=$conn->query($sql);
		$row = mysqli_fetch_array($result);
        header("Content-type: image/jpeg");
		$imagedata =  $row['ann_pic'];
		echo $imagedata;
    }
?>
