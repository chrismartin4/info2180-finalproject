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
	echo "Connected to $dbname at $host successfully.";
	#if statement that executes when the submit button is pressed
	if (isset($_POST['submit_form'])) {    #collecting data from the form using the POST method
		$fname = filter_input(INPUT_POST,'firstname',FILTER_SANITIZE_STRING);
		$lname = filter_input(INPUT_POST,'lastname',FILTER_SANITIZE_STRING);
		$pword = filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING);
		$email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_STRING);
		$hashedpword = password_hash($pword, PASSWORD_DEFAULT);
		$sql = $conn->prepare("INSERT INTO users (firstname, lastname, password, email)
	         VALUES (:fname,:lname,:hashedpword,:email)");

		#binds the parameters to the SQL query and tells the database what the parameters are
		$sql->bindParam(":fname", $fname);
		$sql->bindParam(":lname", $lname);
		$sql->bindParam(":hashedpword", $hashedpword);
		$sql->bindParam(":email", $email);
		#The database executes the SQL statement template with the specified values
		if ($sql->execute()) {
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
