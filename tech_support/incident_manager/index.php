<?php
require('../model/database.php');

$action = filter_input(INPUT_POST, 'action');

if ($action == NULL) {
    $action = 'get_customer';
}

switch ($action) {

    case 'create_incident':

        $customer_id = filter_input(
            INPUT_POST,
            'customer_id',
            FILTER_VALIDATE_INT
        );

        $product_code = filter_input(INPUT_POST, 'product_code');
        $title = filter_input(INPUT_POST, 'title');
        $description = filter_input(INPUT_POST, 'description');

        $query = 'INSERT INTO incidents
                  (customerID, productCode, dateOpened, title, description)
                  VALUES
                  (:customer_id, :product_code, NOW(), :title, :description)';

        $statement = $db->prepare($query);
        $statement->bindValue(':customer_id', $customer_id);
        $statement->bindValue(':product_code', $product_code);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':description', $description);
        $statement->execute();
        $statement->closeCursor();

        include('incident_confirmation.php');

        break;


    case 'get_customer':

        $email = filter_input(INPUT_POST, 'email');

        if ($email == NULL) {
            include('get_customer.php');
            break;
        }

        $query = 'SELECT *
                  FROM customers
                  WHERE email = :email';

        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();

        $customer = $statement->fetch();
        $statement->closeCursor();

        if ($customer == false) {
            $error = 'No customer was found with that email address.';
            include('get_customer.php');
            break;
        }

        $customer_id = $customer['customerID'];
        $first_name = $customer['firstName'];
        $last_name = $customer['lastName'];

        $query = 'SELECT products.productCode, products.name
                  FROM products
                  INNER JOIN registrations
                  ON products.productCode = registrations.productCode
                  WHERE registrations.customerID = :customer_id
                  ORDER BY products.name';

        $statement = $db->prepare($query);
        $statement->bindValue(':customer_id', $customer_id);
        $statement->execute();

        $products = $statement->fetchAll();

        $statement->closeCursor();

        include('create_incident.php');

        break;
}
?>