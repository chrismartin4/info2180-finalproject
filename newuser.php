<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.html");
}
?>

<html>

<head>
    <meta charset="utf-8">
    <title>BugMe Issue Tracker</title>
    <script src="scripts.js" type="text/javascript"></script>
</head>

<h1>New User</h1>
<form method="post" name="form" id="form" action="adduser.php" onsubmit="return validation()">
    <br>
    <label><b>Firstname</b></label>
    <br>
    <input type="text" id="fname" name="firstname" required>
    <br>
    <label><b>Lastname</b></label>
    <br>
    <input type="text" id="lname" name="lastname" required>
    <br>
    <label><b>Password</b></label>
    <br>
    <input type="password" id="pword" name="password" required>
    <br>
    <label><b>Email</b></label>
    <br>
    <input type="email" id="email" name="email" required>

    <br>
    <button type="submit" name="submit_form" id="submit_form">Submit</button>
</form>

</html>