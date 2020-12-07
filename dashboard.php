<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.html");
}
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    die('$' . "_SESSION['user_id'] isn't set because you had never been at file one");
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BugMe Issue Tracker</title>
    <link rel="stylesheet" type="text/css" href="scripts/styles.css">
    <script src="scripts.js" type="text/javascript"></script>
</head>

<body>
    <div class="header">
        <img src="icons/header.png" alt="A bug">
        <h1>BugMe Issue Tracker</h1>
    </div>

    <div class="nav">
        <a href="#" onclick="home();"><img src="icons/home.png" alt="The home button">Home</a>
        <?php if ($user_id == 1) : ?>
            <a href="#" onclick="newUser();"><img src="icons/add-user.png" alt="The add user button">Add User</a>
        <?php endif ?>

        <a href="#" onclick="newIssue();"><img src="icons/add.png" alt="The add new issue button">New Issue</a>
        <a href="#" onclick="logOut();"><img src="icons/log-off.png" alt="The logout button">Logout</a>
        <input type="hidden" name="userID" id="userID" value="<?php echo $_SESSION["user_id"] ?>">
    </div>


    <?php echo '<script type="text/javascript">',
        'home();',
        '</script>'; ?>

    <div id="IssueSection">
        <!-- emails and other content will appear here -->
    </div>

</body>

</html>