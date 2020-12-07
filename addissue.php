<?php
session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    die('$' . "_SESSION['user_id'] isn't set because you had never been at file one");
}
try {
    $host = "localhost";
    $dbname = "BugMe";
    #creates a new PDO instance to represent a connection to a database
    $conn = new PDO('mysql:host=localhost;dbname=BugMe;', 'root', '');
    #if statement that executes when the submit button is pressed
    if (isset($_POST['submit_form'])) {    #collecting data from the form using the POST method
        $title = filter_input(INPUT_POST,'title',FILTER_SANITIZE_STRING);;
        $desc = filter_input(INPUT_POST,'desc',FILTER_SANITIZE_STRING);
        $assignedto = filter_input(INPUT_POST,'assignedto',FILTER_SANITIZE_STRING);
        $keywords = preg_split("/[\s,]+/", $assignedto);
        $names = "SELECT id FROM users WHERE (firstname = '$keywords[0]' AND lastname = '$keywords[1]')";
        $stmt = $conn->query($names);
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        foreach ($results as $name) :
        endforeach;
        $type = filter_input(INPUT_POST,'type',FILTER_SANITIZE_STRING);
        $priority = filter_input(INPUT_POST,'priority',FILTER_SANITIZE_STRING);
        $defaultstatus = "OPEN";
        $sql = $conn->prepare("INSERT INTO issues (title, description, assigned_to, type, priority, status, created_by)
	         VALUES (:title,:desc,:assignedto,:type,:priority,:defaultstatus,:createdby)");

        #binds the parameters to the SQL query and tells the database what the parameters are
        $sql->bindParam(":title", $title);
        $sql->bindParam(":desc", $desc);
        $sql->bindParam(":assignedto", $name);
        $sql->bindParam(":type", $type);
        $sql->bindParam(":priority", $priority);
        $sql->bindParam(":defaultstatus", $defaultstatus);
        $sql->bindParam(":createdby", $user_id);
        #The database executes the SQL statement template with the specified values
        if ($sql->execute()) {
            echo "\n New record created successfully";
            header("Location: dashboard.php");
        } else {
            echo "Unable to create record";
        }
    }
} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}
#terminates database connection
$conn = null;
