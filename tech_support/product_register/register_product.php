<?php
session_start();

require('../model/database.php');

// Make sure the customer is logged in
if (!isset($_SESSION['customer_id'])) {
    header('Location: index.php');
    exit();
}

// Get customer information
$customer_id = $_SESSION['customer_id'];
$first_name = $_SESSION['first_name'];
$last_name = $_SESSION['last_name'];
$email = $_SESSION['email'];

$message = '';

// Get all products
$query = 'SELECT productCode, name
          FROM products
          ORDER BY name';

$statement = $db->prepare($query);
$statement->execute();
$products = $statement->fetchAll();
$statement->closeCursor();

// Register the selected product
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $product_code = filter_input(INPUT_POST, 'product_code');

    if ($product_code != NULL) {

        // Check if the product is already registered
        $query = 'SELECT *
                  FROM registrations
                  WHERE customerID = :customer_id
                  AND productCode = :product_code';

        $statement = $db->prepare($query);
        $statement->bindValue(':customer_id', $customer_id);
        $statement->bindValue(':product_code', $product_code);
        $statement->execute();

        $registration = $statement->fetch();
        $statement->closeCursor();

        if ($registration) {

            $message = 'This product is already registered.';

        } else {

            // Add the registration
            $query = 'INSERT INTO registrations
                      (customerID, productCode, registrationDate)
                      VALUES
                      (:customer_id, :product_code, NOW())';

            $statement = $db->prepare($query);
            $statement->bindValue(':customer_id', $customer_id);
            $statement->bindValue(':product_code', $product_code);
            $statement->execute();
            $statement->closeCursor();

            $message = 'Product was registered successfully.';
        }
    }
}
?>

<?php include '../view/header.php'; ?>

<main>

    <h2>Register Product</h2>

    <p>
        Customer:
        <?php echo htmlspecialchars($first_name . ' ' . $last_name); ?>
    </p>

    <?php if (!empty($message)) : ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <form action="register_product.php" method="post" id="aligned">

        <label>Product:</label>

        <select name="product_code">

            <?php foreach ($products as $product) : ?>

                <option value="<?php echo htmlspecialchars($product['productCode']); ?>">
                    <?php echo htmlspecialchars($product['name']); ?>
                </option>

            <?php endforeach; ?>

        </select>

        <br>

        <label>&nbsp;</label>
        <input type="submit" value="Register Product">

    </form>

    <p>
        You are logged in as <?php echo htmlspecialchars($email); ?>
    </p>

    <p>
        <a href="logout.php">Logout</a>
    </p>

</main>

<?php include '../view/footer.php'; ?>