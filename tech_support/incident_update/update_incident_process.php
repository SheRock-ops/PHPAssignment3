<?php
session_start();

require('../model/database.php');

// Get the incident data
$incident_id = filter_input(
    INPUT_POST,
    'incident_id',
    FILTER_VALIDATE_INT
);

$description = filter_input(
    INPUT_POST,
    'description'
);

$close_incident = filter_input(
    INPUT_POST,
    'close_incident'
);

// Update the incident
if ($close_incident == 'yes') {

    $query = 'UPDATE incidents
              SET description = :description,
                  dateClosed = NOW()
              WHERE incidentID = :incident_id';

} else {

    $query = 'UPDATE incidents
              SET description = :description
              WHERE incidentID = :incident_id';
}

$statement = $db->prepare($query);

$statement->bindValue(
    ':description',
    $description
);

$statement->bindValue(
    ':incident_id',
    $incident_id
);

$statement->execute();
$statement->closeCursor();

// Go to the confirmation page
header('Location: incident_confirmation.php');
exit();
?>