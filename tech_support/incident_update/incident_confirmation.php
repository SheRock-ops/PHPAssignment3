<?php
session_start();
?>

<?php include '../view/header.php'; ?>

<main>

    <h2>Update Incident</h2>

    <p>The incident was updated successfully.</p>

    <p>
        <a href="select_incident.php">
            Select Another Incident
        </a>
    </p>

    <p>
        <a href="index.php">
            Logout
        </a>
    </p>

</main>

<?php include '../view/footer.php'; ?>
