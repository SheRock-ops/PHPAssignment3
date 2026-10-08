<?php
require('../model/database.php');

// Get all customers
$query = 'SELECT customerID, firstName, lastName, email
          FROM customers
          ORDER BY lastName';

$statement = $db->prepare($query);
$statement->execute();
$customers = $statement->fetchAll();
$statement->closeCursor();
?>

<?php include '../view/header.php'; ?>

<main>

    <h2>Manage Customers</h2>

    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>&nbsp;</th>
        </tr>

        <?php foreach ($customers as $customer) : ?>

            <tr>
                <td>
                    <?php
                    echo htmlspecialchars(
                        $customer['firstName'] . ' ' .
                        $customer['lastName']
                    );
                    ?>
                </td>

                <td>
                    <?php
                    echo htmlspecialchars($customer['email']);
                    ?>
                </td>

                <td>
                    <form action="view_customer.php"
                          method="post">

                        <input type="hidden"
                               name="customer_id"
                               value="<?php
                               echo $customer['customerID'];
                               ?>">

                        <input type="submit"
                               value="Select">

                    </form>
                </td>
            </tr>

        <?php endforeach; ?>

    </table>

</main>

<?php include '../view/footer.php'; ?>