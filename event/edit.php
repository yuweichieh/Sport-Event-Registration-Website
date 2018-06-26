<?php
    session_start();
    $conn = new mysqli('localhost', 'root', 'root', 'my_db', 8889);
    if($conn->connect_error)
        die("Connection failed: ". $conn->connect_error);

    $name = $_POST['name'];
    $date = $_POST['date'];
    $rule = $_POST['rule'];
    $team_limit = $_POST['team_limit'];
    $mem_limit = $_POST['mem_limit'];
    $query = "UPDATE events SET name = '$name', date = '$date', rule = '$rule', team_limit = '$team_limit', mem_limit = '$mem_limit' WHERE event_id=".$_SESSION['event_id'];
    //$query = "INSERT INTO announces(title, content) VALUES('$title', '$content')";
    unset($_SESSION['ann_id']);;
    mysqli_query($conn, $query) or die(mysqli_error($conn));
    $_SESSION['message'] = "Event updated!";
    mysqli_close($conn);
    header('location: ./event.php');
?>