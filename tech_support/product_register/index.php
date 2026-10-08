<?php
session_start();

require('../model/database.php');

$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');

$error = '';

if ($email != NULL && $password != NULL) {

    $query = 'SELECT *
              FROM customers
              WHERE email = :email
              AND password = :password';

    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password);
    $statement->execute();

    $customer = $statement->fetch();
    $statement->closeCursor();

    if ($customer) {

        $_SESSION['customer_id'] = $customer['customerID'];
        $_SESSION['first_name'] = $customer['firstName'];
        $_SESSION['last_name'] = $customer['lastName'];
        $_SESSION['email'] = $customer['email'];

        header('Location: register_product.php');
        exit();

    } else {
        $error = 'Invalid email or password.';
    }
}
?>

<?php include '../view/header.php'; ?>

<main>

    <h2>Customer Login</h2>

    <p>You must login before you can register a product.</p>

    <?php if (!empty($error)) : ?>
        <p><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form action="index.php" method="post" id="aligned">

        <label>Email:</label>
        <input type="text" name="email">
        <br>

        <label>Password:</label>
        <input type="password" name="password">
        <br>

        <label>&nbsp;</label>
        <input type="submit" value="Login">

    </form>

</main>

<?php include '../view/footer.php'; ?>