<?php
require('../model/database.php');

// Get the product data
$product_code = filter_input(INPUT_POST, 'product_code');
$name = filter_input(INPUT_POST, 'name');
$version = filter_input(INPUT_POST, 'version');
$release_date = filter_input(INPUT_POST, 'release_date');

// Validate the data
if ($product_code == NULL ||
    $name == NULL ||
    $version == NULL ||
    $release_date == NULL) {

    $error = 'All fields are required.';
    include('add_product_form.php');
    exit();
}

// Convert the release date
$date = strtotime($release_date);

if ($date === false) {
    $error = 'Please enter a valid release date.';
    include('add_product_form.php');
    exit();
}

$release_date = date('Y-m-d', $date);

// Add the product to the database
$query = 'INSERT INTO products
          (productCode, name, version, releaseDate)
          VALUES
          (:product_code, :name, :version, :release_date)';

$statement = $db->prepare($query);
$statement->bindValue(':product_code', $product_code);
$statement->bindValue(':name', $name);
$statement->bindValue(':version', $version);
$statement->bindValue(':release_date', $release_date);
$statement->execute();
$statement->closeCursor();

// Return to the Product List
header('Location: index.php');
exit();
?>