<?php include '../view/header.php'; ?>

<main>

    <h2>Add Technician</h2>

    <?php if (!empty($error)) : ?>
        <p><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form action="add_technician.php"
          method="post"
          id="aligned">

        <label>First Name:</label>
        <input type="text" name="first_name">
        <br>

        <label>Last Name:</label>
        <input type="text" name="last_name">
        <br>

        <label>Email:</label>
        <input type="text" name="email">
        <br>

        <label>Phone:</label>
        <input type="text" name="phone">
        <br>

        <label>Password:</label>
        <input type="text" name="password">
        <br>

        <label>&nbsp;</label>
        <input type="submit" value="Add Technician">

    </form>

    <p>
        <a href="index.php">View Technician List</a>
    </p>

</main>

<?php include '../view/footer.php'; ?>