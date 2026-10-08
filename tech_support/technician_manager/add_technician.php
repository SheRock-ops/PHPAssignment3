<?php
require('../model/database.php');

// Get the technician data
$first_name = filter_input(INPUT_POST, 'first_name');
$last_name = filter_input(INPUT_POST, 'last_name');
$email = filter_input(INPUT_POST, 'email');
$phone = filter_input(INPUT_POST, 'phone');
$password = filter_input(INPUT_POST, 'password');

// Validate the data
if ($first_name == NULL ||
    $last_name == NULL ||
    $email == NULL ||
    $phone == NULL ||
    $password == NULL) {

    $error = 'All fields are required.';
    include('add_technician_form.php');
    exit();
}

// Add the technician to the database
$query = 'INSERT INTO technicians
          (firstName, lastName, email, phone, password)
          VALUES
          (:first_name, :last_name, :email, :phone, :password)';

$statement = $db->prepare($query);
$statement->bindValue(':first_name', $first_name);
$statement->bindValue(':last_name', $last_name);
$statement->bindValue(':email', $email);
$statement->bindValue(':phone', $phone);
$statement->bindValue(':password', $password);
$statement->execute();
$statement->closeCursor();

// Return to the Technician List
header('Location: index.php');
exit();
?>