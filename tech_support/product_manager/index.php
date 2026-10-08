<?php
require('../model/database.php');

// Get all products
$query = 'SELECT *
          FROM products
          ORDER BY productCode';

$statement = $db->prepare($query);
$statement->execute();
$products = $statement->fetchAll();
$statement->closeCursor();
?>

<?php include '../view/header.php'; ?>

<main>

    <h2>Product List</h2>

    <table>
        <tr>
            <th>Code</th>
            <th>Name</th>
            <th>Version</th>
            <th>Release Date</th>
        </tr>

        <?php foreach ($products as $product) : ?>

            <tr>
                <td>
                    <?php echo htmlspecialchars($product['productCode']); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($product['name']); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($product['version']); ?>
                </td>

                <td>
                    <?php
                    $release_date =
                        strtotime($product['releaseDate']);

                    echo date('n-j-Y', $release_date);
                    ?>
                </td>
            </tr>

        <?php endforeach; ?>

    </table>

    <p>
        <a href="add_product_form.php">Add Product</a>
    </p>

</main>

<?php include '../view/footer.php'; ?>