<?php
require('../model/database.php');

$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');

$error = '';

if ($email != NULL && $password != NULL) {

    $query = 'SELECT *
              FROM technicians
              WHERE email = :email
              AND password = :password';

    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password);
    $statement->execute();

    $technician = $statement->fetch();
    $statement->closeCursor();

    if ($technician) {

        session_start();

        $_SESSION['tech_id'] = $technician['techID'];
        $_SESSION['first_name'] = $technician['firstName'];
        $_SESSION['last_name'] = $technician['lastName'];
        $_SESSION['email'] = $technician['email'];

        header('Location: select_incident.php');
        exit();

    } else {
        $error = 'Invalid email or password.';
    }
}
?>

<?php include '../view/header.php'; ?>

<main>

    <h2>Technician Login</h2>

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