<?php
require('../model/database.php');

$customer_id = filter_input(
    INPUT_POST,
    'customer_id',
    FILTER_VALIDATE_INT
);

// Get the selected customer
$query = 'SELECT *
          FROM customers
          WHERE customerID = :customer_id';

$statement = $db->prepare($query);
$statement->bindValue(':customer_id', $customer_id);
$statement->execute();
$customer = $statement->fetch();
$statement->closeCursor();

// Get all countries
$query = 'SELECT *
          FROM countries
          ORDER BY countryName';

$statement = $db->prepare($query);
$statement->execute();
$countries = $statement->fetchAll();
$statement->closeCursor();
?>

<?php include '../view/header.php'; ?>

<main>

    <h2>View/Update Customer</h2>

    <form action="update_customer.php"
          method="post"
          id="aligned">

        <input type="hidden"
               name="customer_id"
               value="<?php echo $customer['customerID']; ?>">

        <label>First Name:</label>
        <input type="text"
               name="first_name"
               value="<?php echo htmlspecialchars($customer['firstName']); ?>">
        <br>

        <label>Last Name:</label>
        <input type="text"
               name="last_name"
               value="<?php echo htmlspecialchars($customer['lastName']); ?>">
        <br>

        <label>Address:</label>
        <input type="text"
               name="address"
               value="<?php echo htmlspecialchars($customer['address']); ?>">
        <br>

        <label>City:</label>
        <input type="text"
               name="city"
               value="<?php echo htmlspecialchars($customer['city']); ?>">
        <br>

        <label>State:</label>
        <input type="text"
               name="state"
               value="<?php echo htmlspecialchars($customer['state']); ?>">
        <br>

        <label>Postal Code:</label>
        <input type="text"
               name="postal_code"
               value="<?php echo htmlspecialchars($customer['postalCode']); ?>">
        <br>

        <label>Country:</label>
        <select name="country_code">

            <?php foreach ($countries as $country) : ?>

                <option
                    value="<?php echo $country['countryCode']; ?>"

                    <?php
                    if ($country['countryCode'] ==
                        $customer['countryCode']) {
                        echo 'selected';
                    }
                    ?>>

                    <?php
                    echo htmlspecialchars($country['countryName']);
                    ?>

                </option>

            <?php endforeach; ?>

        </select>
        <br>

        <label>Phone:</label>
        <input type="text"
               name="phone"
               value="<?php echo htmlspecialchars($customer['phone']); ?>">
        <br>

        <label>Email:</label>
        <input type="text"
               name="email"
               value="<?php echo htmlspecialchars($customer['email']); ?>">
        <br>

        <label>Password:</label>
        <input type="text"
               name="password"
               value="<?php echo htmlspecialchars($customer['password']); ?>">
        <br>

        <label>&nbsp;</label>
        <input type="submit"
               value="Update Customer">

    </form>

</main>

<?php include '../view/footer.php'; ?>