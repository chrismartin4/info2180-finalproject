<?php
session_start();
if (isset($_SESSION['user_id'])) {
    $id = $_SESSION['user_id'];
} else {
    die('$' . "_SESSION['user_id'] isn't set because you had never been at file one");
}
try {
    $host = "localhost";
    $dbname = "BugMe";
    #creates a new PDO instance to represent a connection to a database
    $conn = new PDO('mysql:host=localhost;dbname=BugMe;', 'root', '');
    $newstatus = filter_input(INPUT_GET, 'query', FILTER_SANITIZE_STRING);
    $changes1 = "UPDATE issues SET status = '$newstatus' WHERE id = '$id'";
    $conn->query($changes1);
    date_default_timezone_set('America/Jamaica');
    $dt = date('Y-m-d H:i:s', time());
    $changes2 = "UPDATE issues SET updated = '$dt' WHERE id = '$id'";
    $conn->query($changes2);
    echo "Field Updated";
    header("Location: home.php");
} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}
