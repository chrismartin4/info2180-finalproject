<?php
session_start();

try {
    $host = "localhost";
    $dbname = "BugMe";
    #creates a new PDO instance to represent a connection to a database
    $conn = new PDO('mysql:host=localhost;dbname=BugMe;', 'root', '');

    $id = filter_input(INPUT_GET, 'query', FILTER_SANITIZE_STRING);
    if (isset($_SESSION['user_id'])) {
        $_SESSION['user_id'] = $id;
    } else {
        die('$' . "_SESSION['user_id'] isn't set because you had never been at file one");
    }
    $titles = "SELECT * FROM issues WHERE id='$id'";
    $stmt = $conn->query($titles);
    $results = $stmt->fetch(PDO::FETCH_ASSOC);

    $temp = $results['created_by'];
    $names = "SELECT * FROM users WHERE id='$temp'";
    $stmt2 = $conn->query($names);
    $results2 = $stmt2->fetch(PDO::FETCH_ASSOC);

    $temp1 = $results['assigned_to'];
    $names = "SELECT * FROM users WHERE id='$temp1'";
    $stmt3 = $conn->query($names);
    $results3 = $stmt3->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}

$createdby = $results2['firstname'] . " " . $results2['lastname'];
$assignedto = $results3['firstname'] . " " . $results3['lastname'];
$conn = null;
?>

<html>
<div class="entirebox">
    <div class="headers">
        <h1><?php echo $results['title']; ?></h1>
        <h2>Issue #<?php echo $results['id'] ?></h2>
    </div>
    <div class="textbox">
        <p><?php echo $results['description'] ?></p>

        <ul>
            <li>Issue created on <?php echo date("F j, Y", strtotime($results['created'])) . " at " . date("g:iA", strtotime($results['created'])) . " by " . $createdby ?></li>
            <li>Last updated on <?php echo date("F j, Y", strtotime($results['updated'])) . " at " . date("g:iA", strtotime($results['updated'])) ?></li>
        </ul>
    </div>
    <div class="sidebar">
        <div class="fields">
            <p><b>Assigned to</b><br><?php echo $assignedto ?></p>
            <p><b>Type</b><br><?php echo $results['type'] ?></p>
            <p><b>Priority</b><br><?php echo $results['priority'] ?></p>
            <p><b>Status</b><br><?php echo $results['status'] ?></p>
        </div>
        <div class="buttons">

            <button type="submit" name="submit_form" id="closed" onclick="markC();">Mark as Closed</button>
            <button type="submit" name="submit_form" id="progress" onclick="markP();">Mark In Progress</button>
        </div>
    </div>
</div>

</html>