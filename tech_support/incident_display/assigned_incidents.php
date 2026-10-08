<?php
require('../model/database.php');

// Get all assigned incidents
$query = 'SELECT incidents.incidentID,
                 incidents.dateOpened,
                 incidents.dateClosed,
                 incidents.title,
                 incidents.description,
                 customers.firstName,
                 customers.lastName,
                 products.name AS productName,
                 technicians.firstName AS techFirstName,
                 technicians.lastName AS techLastName
          FROM incidents
          JOIN customers
              ON incidents.customerID = customers.customerID
          JOIN products
              ON incidents.productCode = products.productCode
          JOIN technicians
              ON incidents.techID = technicians.techID
          WHERE incidents.techID IS NOT NULL
          ORDER BY incidents.dateOpened';

$statement = $db->prepare($query);
$statement->execute();
$incidents = $statement->fetchAll();
$statement->closeCursor();
?>

<?php include '../view/header.php'; ?>

<main>

    <h2>Assigned Incidents</h2>

    <table>
        <tr>
            <th>Customer</th>
            <th>Product</th>
            <th>Incident ID</th>
            <th>Date Opened</th>
            <th>Title</th>
            <th>Description</th>
            <th>Technician</th>
            <th>Date Closed</th>
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
                    <?php echo htmlspecialchars(
                        $incident['productName']
                    ); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars(
                        $incident['incidentID']
                    ); ?>
                </td>

                <td>
                    <?php
                    echo date(
                        'n-j-Y',
                        strtotime($incident['dateOpened'])
                    );
                    ?>
                </td>

                <td>
                    <?php echo htmlspecialchars(
                        $incident['title']
                    ); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars(
                        $incident['description']
                    ); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars(
                        $incident['techFirstName'] . ' ' .
                        $incident['techLastName']
                    ); ?>
                </td>

                <td>
                    <?php
                    if ($incident['dateClosed'] == NULL) {
                        echo 'OPEN';
                    } else {
                        echo date(
                            'n-j-Y',
                            strtotime($incident['dateClosed'])
                        );
                    }
                    ?>
                </td>
            </tr>

        <?php endforeach; ?>

    </table>

    <p>
        <a href="index.php">
            View Unassigned Incidents
        </a>
    </p>

</main>

<?php include '../view/footer.php'; ?>