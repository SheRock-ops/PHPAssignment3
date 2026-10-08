<?php
session_start();

require('../model/database.php');

// Make sure the technician is logged in
if (!isset($_SESSION['tech_id'])) {
    header('Location: index.php');
    exit();
}

// Get technician information
$tech_id = $_SESSION['tech_id'];
$first_name = $_SESSION['first_name'];
$last_name = $_SESSION['last_name'];
$email = $_SESSION['email'];

// Get open incidents assigned to this technician
$query = 'SELECT incidents.incidentID,
                 incidents.productCode,
                 incidents.dateOpened,
                 incidents.title,
                 incidents.description
          FROM incidents
          WHERE incidents.techID = :tech_id
          AND incidents.dateClosed IS NULL
          ORDER BY incidents.dateOpened';

$statement = $db->prepare($query);
$statement->bindValue(':tech_id', $tech_id);
$statement->execute();

$incidents = $statement->fetchAll();
$statement->closeCursor();
?>

<?php include '../view/header.php'; ?>

<main>

    <h2>Select Incident</h2>

    <p>
        Technician:
        <?php echo htmlspecialchars($first_name . ' ' . $last_name); ?>
    </p>

    <?php if (count($incidents) > 0) : ?>

        <table>

            <tr>
                <th>Product</th>
                <th>Date Opened</th>
                <th>Title</th>
                <th></th>
            </tr>

            <?php foreach ($incidents as $incident) : ?>

                <tr>

                    <td>
                        <?php echo htmlspecialchars($incident['productCode']); ?>
                    </td>

                    <td>
                        <?php
                        $date_opened = strtotime($incident['dateOpened']);
                        echo date('n-j-Y', $date_opened);
                        ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($incident['title']); ?>
                    </td>

                    <td>
                        <form action="update_incident.php" method="post">

                            <input type="hidden"
                                   name="incident_id"
                                   value="<?php echo $incident['incidentID']; ?>">

                            <input type="submit" value="Select">

                        </form>
                    </td>

                </tr>

            <?php endforeach; ?>

        </table>

    <?php else : ?>

        <p>There are no open incidents for this technician.</p>

        <p>
            <a href="select_incident.php">
                Refresh List of Incidents
            </a>
        </p>

    <?php endif; ?>

    <p>
        You are logged in as <?php echo htmlspecialchars($email); ?>
    </p>

    <p>
        <a href="logout.php">Logout</a>
    </p>

</main>

<?php include '../view/footer.php'; ?>