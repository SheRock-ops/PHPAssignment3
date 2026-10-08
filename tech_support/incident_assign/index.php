<?php
require('../model/database.php');

// Get all unassigned incidents
$query = 'SELECT incidents.incidentID,
                 incidents.dateOpened,
                 incidents.title,
                 customers.firstName,
                 customers.lastName,
                 products.name
          FROM incidents
          INNER JOIN customers
          ON incidents.customerID = customers.customerID
          INNER JOIN products
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

    <h2>Assign Incident</h2>

    <h3>Select Incident</h3>

    <table>
        <tr>
            <th>Customer</th>
            <th>Product</th>
            <th>Title</th>
            <th>Date Opened</th>
            <th>&nbsp;</th>
        </tr>

        <?php foreach ($incidents as $incident) : ?>

            <tr>
                <td>
                    <?php
                    echo htmlspecialchars(
                        $incident['firstName'] . ' ' .
                        $incident['lastName']
                    );
                    ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($incident['name']); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($incident['title']); ?>
                </td>

                <td>
                    <?php
                    $date_opened = strtotime($incident['dateOpened']);
                    echo date('n-j-Y', $date_opened);
                    ?>
                </td>

                <td>
                    <form action="select_technician.php" method="post">
                        <input type="hidden"
                               name="incident_id"
                               value="<?php echo $incident['incidentID']; ?>">
                        <input type="submit" value="Select">
                    </form>
                </td>
            </tr>

        <?php endforeach; ?>

    </table>

</main>

<?php include '../view/footer.php'; ?>