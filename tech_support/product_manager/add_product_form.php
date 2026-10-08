<?php include '../view/header.php'; ?>

<main>

    <h2>Add Product</h2>

    <?php if (isset($error) && !empty($error)) : ?>
        <p><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form action="add_product.php"
          method="post"
          id="aligned">

        <label>Code:</label>
        <input type="text" name="product_code">
        <br>

        <label>Name:</label>
        <input type="text" name="name">
        <br>

        <label>Version:</label>
        <input type="text" name="version">
        <br>

        <label>Release Date:</label>
        <input type="text" name="release_date">
        <br>

        <label>&nbsp;</label>
        <input type="submit" value="Add Product">

    </form>

    <p>
        <a href="index.php">View Product List</a>
    </p>

</main>

<?php include '../view/footer.php'; ?>