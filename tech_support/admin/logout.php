<?php
session_start();

// Remove the admin login session
unset($_SESSION['is_valid_admin']);

// End the session
session_destroy();

// Return to the Admin Login page
header('Location: index.php');
exit();
?>