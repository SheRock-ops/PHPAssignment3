<?php
session_start();

// Remove all session data
$_SESSION = array();

// Destroy the session
session_destroy();

// Return to the Technician Login page
header('Location: index.php');
exit();
?>