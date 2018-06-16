<?php
    session_start();
    $conn = new mysqli('localhost', 'root', 'root', 'my_db', 8889);
    if($conn->connect_error)
        die("Connection failed: ". $conn->connect_error);

    $title = $_POST['title'];
    $content = $_POST['content'];

    $query = "INSERT INTO announces(title, content) VALUES('$title', '$content')";
    mysqli_query($conn, $query) or die(mysqli_error($conn));
    $_SESSION['message'] = "New announcement added!";
    mysqli_close($conn);
    header('location: ../index.php');
?>