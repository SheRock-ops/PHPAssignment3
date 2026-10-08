<?php
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');

    if ($username == 'admin' && $password == 'sesame') {
        $_SESSION['is_valid_admin'] = true;

        header('Location: admin_menu.php');
        exit();
    } else {
        $error = 'Invalid username or password.';
    }
}
?>

<?php include '../view/header.php'; ?>

<main>

    <h2>Admin Login</h2>

    <?php if ($error != '') : ?>
        <p><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form action="index.php" method="post">

        <label>Username:</label>
        <input type="text" name="username">
        <br>

        <label>Password:</label>
        <input type="password" name="password">
        <br>

        <label>&nbsp;</label>
        <input type="submit" value="Login">

    </form>

</main>

<?php include '../view/footer.php'; ?>