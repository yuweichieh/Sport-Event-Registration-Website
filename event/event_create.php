<?php
    session_start();
    $conn = new mysqli('localhost', 'root', 'root', 'my_db', 8889);
    if($conn->connect_error)
        die("Connection failed: ". $conn->connect_error);

    $name = $_POST['name'];
    $date = $_POST['date'];
    $rule = $_POST['rule'];
    $mem_limit = $_POST['mem_limit'];
    $team_limit = $_POST['team_limit'];

    $query = "INSERT INTO events(name, date, rule, mem_limit, team_limit) VALUES('$name', '$date', '$rule', '$mem_limit', '$team_limit')";
    mysqli_query($conn, $query) or die(mysqli_error($conn));
    $_SESSION['message'] = "New event added!";
    mysqli_close($conn);
    header('location: ../index.php');
?>