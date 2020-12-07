<?php
try {
    $host = "localhost";
    $dbname = "BugMe";
    #creates a new PDO instance to represent a connection to a database
    $conn = new PDO('mysql:host=localhost;dbname=BugMe;', 'root', '');
    $names = "SELECT firstname, lastname FROM users";
    $stmt = $conn->query($names);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}
$conn = null;
?>

<html lang="en">
<div class="bdy">
    <h1>New Issue</h1>
    <form method="post" name="form" id="form" action="addissue.php">
        <div class="container">
            <label><b>Title</b></label>
            <br>
            <input type="text" id="title" name="title" required>
            <br>
            <label><b>Description</b></label>
            <br>
            <input type="text" id="desc" name="desc" required>
            <br>
            <label for="assignedto"><b>Assigned To</b></label>
            <br>
            <select name="assignedto" id="assignedto">
                <?php foreach ($results as $name) : ?>
                    <?php $fullname = $name['firstname'] . " " . $name['lastname']; ?>
                    <option value="<?php echo $fullname; ?>"><?php echo $fullname; ?></option>
                <?php endforeach; ?>
            </select>
            <br>
            <label for="type"><b>Type</b></label>
            <br>
            <select name="type" id="type">
                <option value="Bug">Bug</option>
                <option value="Proposal">Proposal</option>
                <option value="Task">Task</option>
            </select>
            <br>

            <label for="priority"><b>Priority</b></label>
            <br>
            <select name="priority" id="priority">
                <option value="Minor">Minor</option>
                <option value="Major">Major</option>
                <option value="Critical">Critical</option>
            </select>
            <br>

            <button type="submit" name="submit_form" id="submit_form">Submit</button>
        </div>
    </form>
</div>

</html>