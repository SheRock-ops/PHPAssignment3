<?php
require('../model/database.php');

// Get the incident ID and technician ID
$incident_id = filter_input(
    INPUT_POST,
    'incident_id',
    FILTER_VALIDATE_INT
);

$tech_id = filter_input(
    INPUT_POST,
    'tech_id',
    FILTER_VALIDATE_INT
);

// Assign the technician to the incident
$query = 'UPDATE incidents
          SET techID = :tech_id
          WHERE incidentID = :incident_id';

$statement = $db->prepare($query);
$statement->bindValue(':tech_id', $tech_id);
$statement->bindValue(':incident_id', $incident_id);
$statement->execute();
$statement->closeCursor();

// Return to the unassigned incident list
header('Location: index.php');
exit();
?>