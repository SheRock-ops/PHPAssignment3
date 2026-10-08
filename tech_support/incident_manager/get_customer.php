<?php include '../view/header.php'; ?>

<main>

    <h2>Get Customer</h2>

    <p>You must enter the customer's email address.</p>

    <?php if (isset($error)) { ?>
        <p class="error"><?php echo $error; ?></p>
    <?php } ?>

    <form action="index.php" method="post" id="aligned">
    <input type="hidden" name="action" value="get_customer">

        <label>Email:</label>
        <input type="text" name="email">
        <br>

        <label>&nbsp;</label>
        <input type="submit" value="Get Customer">

    </form>

</main>

<?php include '../view/footer.php'; ?>