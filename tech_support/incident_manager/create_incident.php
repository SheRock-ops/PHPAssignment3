<?php include '../view/header.php'; ?>

<main>

    <h2>Create Incident</h2>

    <p>
        Customer:
        <?php echo htmlspecialchars($first_name . ' ' . $last_name); ?>
    </p>

    <form action="index.php" method="post" id="aligned">
    <input type="hidden" name="action" value="create_incident">

        <input type="hidden"
               name="customer_id"
               value="<?php echo $customer_id; ?>">

        <label>Product:</label>
        <select name="product_code">
            <?php foreach ($products as $product) : ?>
                <option value="<?php echo $product['productCode']; ?>">
                    <?php echo htmlspecialchars($product['name']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br>

        <label>Title:</label>
        <input type="text" name="title">
        <br>

        <label>Description:</label>
        <textarea name="description"
                  rows="5"
                  cols="30"></textarea>
        <br>

        <label>&nbsp;</label>
        <input type="submit"
               value="Create Incident">

    </form>

</main>

<?php include '../view/footer.php'; ?>