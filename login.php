<?php
session_start();

function userLogin($emailAddress, $password)
{
    if (!(CheckLoginInDB($emailAddress, $password))) {
        echo "Login Failed";
        header("Location: login.html");
    } else {
        header("Location: dashboard.php");
    }
}

function CheckLoginInDB($emailAddress, $password)
{
    $connect = new PDO('mysql:host=localhost;dbname=BugMe;', 'root', '');
    $checkLoginQuery = "SELECT id, firstname, lastname, email, password FROM users WHERE email ='$emailAddress'";
    $stmt = $connect->query($checkLoginQuery);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($emailAddress == $result['email'] && (password_verify($password, $result['password']) || MD5($password) == $result['password'])) {
        $_SESSION["user_id"] = $result['id'];
        $_SESSION["firstname"] = $result['firstname'];
        $_SESSION["lastname"] = $result['lastname'];
        $_SESSION["issue"] = "";
        return true;
    } else {
        return false;
    }
}

if (isset($_POST['submit_form'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    userLogin($email, $password);
}