<?php
require('../model/database.php');

// Get all unassigned incidents
$query = 'SELECT incidents.incidentID,
                 incidents.dateOpened,
                 incidents.title,
                 incidents.description,
                 customers.firstName,
                 customers.lastName,
                 products.name AS productName
          FROM incidents
          JOIN customers
              ON incidents.customerID = customers.customerID
          JOIN products
              ON incidents.productCode = products.productCode
          WHERE incidents.techID IS NULL
          ORDER BY incidents.dateOpened';

$statement = $db->prepare($query);
$statement->execute();
$incidents = $statement->fetchAll();
$statement->closeCursor();
?>
<?php include '../view/header.php'; ?>

<main>

    <h2>Unassigned Incidents</h2>

    <table>
        <tr>
            <th>Customer</th>
            <th>Product</th>
            <th>Incident ID</th>
            <th>Date Opened</th>
            <th>Title</th>
            <th>Description</th>
        </tr>

        <?php foreach ($incidents as $incident) : ?>

            <tr>
                <td>
                    <?php echo htmlspecialchars(
                        $incident['firstName'] . ' ' .
                        $incident['lastName']
                    ); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($incident['productName']); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($incident['incidentID']); ?>
                </td>

                <td>
                   <?php echo date(
                             'n-j-Y',
                             strtotime($incident['dateOpened'])
                   );
                   ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($incident['title']); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($incident['description']); ?>
                </td>
            </tr>

        <?php endforeach; ?>

    </table>

    <p>
        <a href="assigned_incidents.php">
            View Assigned Incidents
        </a>
    </p>

</main>

<?php include '../view/footer.php'; ?>