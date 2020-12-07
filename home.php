<?php
try {
    $host = "localhost";
    $dbname = "BugMe";
    #creates a new PDO instance to represent a connection to a database
    $conn = new PDO('mysql:host=localhost;dbname=BugMe;', 'root', '');

    $titles = "SELECT * FROM issues";
    $stmt = $conn->query($titles);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}

?>
<link rel="stylesheet" type="text/css" href="scripts/styles.css">

<div class="bdy">
    <div class="hbar">
        <h1 class="hbaritem1">Issues</h1>
        <button class="hbaritem2" type="submit" onclick="newIssue();">Create New Issue</button>

    </div>
    <div class="fillbar">
        <p class="fillitem">Filter by: </p>
        <button class="fillitem" type="submit" onclick="filterAll();">ALL</button>
        <button class="fillitem" type="submit" onclick="filterOpen();">OPEN</button>
        <button class="fillitem" type="submit" onclick="filterMyTickets();">MY TICKETS</button>
    </div>
    <div class="rslt">

        <table>
            <tr>
                <th>Title</th>
                <th>Type</th>
                <th>Status</th>
                <th>Assigned To</th>
                <th>Created</th>
            </tr>

            <?php foreach ($results as $row) : ?>
                <?php $temp1 = $row['assigned_to'];
                $names = "SELECT * FROM users WHERE id='$temp1'";
                $stmt3 = $conn->query($names);
                $results3 = $stmt3->fetch(PDO::FETCH_ASSOC);
                $assignedto = $results3['firstname'] . " " . $results3['lastname']; ?>
                <?php $id = $row['id'] ?>
                <tr>
                    <td><?php echo "<b>#" . $row['id'] . "</b> <a href='#' onClick='issueDetails($id);'>" . $row['title'];
                        "</a>" ?></td>
                    <td><?php echo $row['type']; ?></td>
                    <?php if ($row['status'] == "CLOSED") : ?>
                        <div class="closed">
                            <td class="closed"><?php echo $row['status']; ?></td>
                        </div>
                    <?php endif ?>
                    <?php if ($row['status'] == "OPEN") : ?>
                        <div class="open">
                            <td class="open"><?php echo $row['status']; ?></td>
                        </div>
                    <?php endif ?>
                    <?php if ($row['status'] == "IN PROGRESS") : ?>
                        <div class="prog">
                            <td class="prog"><?php echo $row['status']; ?></td>
                        </div>
                    <?php endif ?>
                    <td><?php echo $assignedto; ?></td>
                    <td><?php echo date("Y-m-d", strtotime($row['created'])); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <?php $conn = null;
        ?>
    </div>
</div>