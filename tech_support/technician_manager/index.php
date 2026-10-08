<?php
require('../model/database.php');

// Get all technicians
$query = 'SELECT *
          FROM technicians
          ORDER BY lastName';

$statement = $db->prepare($query);
$statement->execute();
$technicians = $statement->fetchAll();
$statement->closeCursor();
?>

<?php include '../view/header.php'; ?>

<main>

    <h2>Technician List</h2>

    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Password</th>
            <th>&nbsp;</th>
        </tr>

        <?php foreach ($technicians as $technician) : ?>

            <tr>
                <td>
                    <?php
                    echo htmlspecialchars(
                        $technician['firstName'] . ' ' .
                        $technician['lastName']
                    );
                    ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($technician['email']); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($technician['phone']); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($technician['password']); ?>
                </td>

                <td>
                    <form action="delete_technician.php"
                          method="post">

                        <input type="hidden"
                               name="tech_id"
                               value="<?php echo $technician['techID']; ?>">

                        <input type="submit"
                               value="Delete">

                    </form>
                </td>
            </tr>

        <?php endforeach; ?>

    </table>

    <p>
        <a href="add_technician_form.php">
            Add Technician
        </a>
    </p>

</main>

<?php include '../view/footer.php'; ?>