<?php

// Savier Osman
// 12/05/2022
// Modified class and object statements to use stadard methods rather than static methods.

require('../model/database.php');
require('../model/category.php');
require('../model/category_db.php');
require('../model/product.php');
require('../model/product_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_products';
    }
}  

if ($action == 'list_products') {
    $category_id = filter_input(INPUT_GET, 'category_id', 
            FILTER_VALIDATE_INT);
    if ($category_id == NULL || $category_id == FALSE) {
        $category_id = 1;
    }

    // Get product and category data
    // Added code to create CategoryDB object and get category.
    $categoryDB = new CategoryDB();
    $current_category = $categoryDB->getCategory($category_id);

    // Added code to get categories.
    $categories = $categoryDB->getCategories();

    // Added code to create ProductDB object and get products.
    $productDB = new ProductDB();
    $products = $productDB->getProductsByCategory($category_id);

    // Display the product list
    include('product_list.php');
} else if ($action == 'delete_product') {
    // Get the IDs
    $product_id = filter_input(INPUT_POST, 'product_id', 
            FILTER_VALIDATE_INT);
    $category_id = filter_input(INPUT_POST, 'category_id', 
            FILTER_VALIDATE_INT);

    // Delete the product
    // Added code to create ProductDB object and delete the product.
    $productDB = new ProductDB();
    $productDB->deleteProduct($product_id);

    // Display the Product List page for the current category
    header("Location: .?category_id=$category_id");
} else if ($action == 'show_add_form') {

    // Added code to create CategoryDB object and get categories.
    $categoryDB = new CategoryDB();
    $categories = $categoryDB->getCategories();
    include('product_add.php');
} else if ($action == 'add_product') {
    $category_id = filter_input(INPUT_POST, 'category_id', 
            FILTER_VALIDATE_INT);
    $code = filter_input(INPUT_POST, 'code');
    $name = filter_input(INPUT_POST, 'name');
    $price = filter_input(INPUT_POST, 'price');
    if ($category_id == NULL || $category_id == FALSE || $code == NULL || 
            $name == NULL || $price == NULL || $price == FALSE) {
        $error = "Invalid product data. Check all fields and try again.";
        include('../errors/error.php');
    } else {
        // Added code to create CategoryDB object and get category.
        $categoryDB = new CategoryDB();
        $current_category = $categoryDB->getCategory($category_id);
        // Modified code to call constructor will zero arguments and set attributes individually
        $product = new Product();
        $product->setCategory($current_category);
        $product->setCode($code);
        $product->setName($name);
        $product->setPrice($price);

        // Added code to create ProductDB object and get products.
        $productDB = new ProductDB();
        $productDB->addProduct($product);

        // Display the Product List page for the current category
        header("Location: .?category_id=$category_id");
    }
}
?>