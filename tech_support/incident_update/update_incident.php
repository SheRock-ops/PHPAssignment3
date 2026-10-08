<?php
session_start();

require('../model/database.php');

// Make sure the technician is logged in
if (!isset($_SESSION['tech_id'])) {
    header('Location: index.php');
    exit();
}

// Get the incident ID
$incident_id = filter_input(
    INPUT_POST,
    'incident_id',
    FILTER_VALIDATE_INT
);

// Get the incident information
$query = 'SELECT *
          FROM incidents
          WHERE incidentID = :incident_id';

$statement = $db->prepare($query);
$statement->bindValue(':incident_id', $incident_id);
$statement->execute();

$incident = $statement->fetch();
$statement->closeCursor();
?>

<?php include '../view/header.php'; ?>

<main>

    <h2>Update Incident</h2>

    <form action="update_incident_process.php"
          method="post"
          id="aligned">

        <input type="hidden"
               name="incident_id"
               value="<?php echo $incident['incidentID']; ?>">

        <label>Product:</label>
        <span>
            <?php echo htmlspecialchars($incident['productCode']); ?>
        </span>
        <br>

        <label>Date Opened:</label>
        <span>
            <?php
            $date_opened = strtotime($incident['dateOpened']);
            echo date('n-j-Y', $date_opened);
            ?>
        </span>
        <br>

        <label>Title:</label>
        <span>
            <?php echo htmlspecialchars($incident['title']); ?>
        </span>
        <br>

        <label>Description:</label>
        <textarea name="description"
                  rows="5"
                  cols="40"><?php echo htmlspecialchars($incident['description']); ?></textarea>
        <br>

        <label>Date Closed:</label>
        <input type="checkbox"
               name="close_incident"
               value="yes">
        <br>

        <label>&nbsp;</label>
        <input type="submit"
               value="Update Incident">

    </form>

</main>

<?php include '../view/footer.php'; ?>