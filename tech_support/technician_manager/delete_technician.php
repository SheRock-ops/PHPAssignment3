<?php
require('../model/database.php');

// Get technician ID
$tech_id = filter_input(
    INPUT_POST,
    'tech_id',
    FILTER_VALIDATE_INT
);

// Delete the technician
if ($tech_id != false) {

    $query = 'DELETE FROM technicians
              WHERE techID = :tech_id';

    $statement = $db->prepare($query);
    $statement->bindValue(':tech_id', $tech_id);
    $statement->execute();
    $statement->closeCursor();
}

// Return to the Technician List
header('Location: index.php');
exit();
?>