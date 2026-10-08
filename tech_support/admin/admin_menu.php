<?php
session_start();

// Make sure the administrator is logged in
if (!isset($_SESSION['is_admin'])) {
    header('Location: index.php');
    exit();
}
?>

<?php include '../view/header.php'; ?>

<main>

    <h2>Admin Menu</h2>

    <nav>
        <ul>
            <li>
                <a href="../product_manager/">
                    Manage Products
                </a>
            </li>

            <li>
                <a href="../technician_manager/">
                    Manage Technicians
                </a>
            </li>

            <li>
                <a href="../customer_manager/">
                    Manage Customers
                </a>
            </li>

            <li>
                <a href="../incident_manager/">
                    Create Incident
                </a>
            </li>

            <li>
                <a href="../incident_assign/">
                    Assign Incident
                </a>
            </li>

            <li>
                <a href="../incident_display/">
                    Display Incidents
                </a>
            </li>
        </ul>
    </nav>

    <p>
        <a href="logout.php">Logout</a>
    </p>

</main>

<?php include '../view/footer.php'; ?>