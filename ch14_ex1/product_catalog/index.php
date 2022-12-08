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

    // Added code to create CategoryDB object and get category.
    $categoryDB = new CategoryDB();
    $current_category = $categoryDB->getCategory($category_id);

    // Added code to get categories.
    $categories = $categoryDB->getCategories();

    // Added code to create ProductDB object and get products.
    $productDB = new ProductDB();
    $products = $productDB->getProductsByCategory($category_id);

    include('product_list.php');
} else if ($action == 'view_product') {

    // Added code to create CategoryDB object and get categories.
    $categoryDB = new CategoryDB();
    $categories = $categoryDB->getCategories();

    $product_id = filter_input(INPUT_GET, 'product_id', 
            FILTER_VALIDATE_INT);   

    // Added code to create ProductDB object and get product.
    $productDB = new ProductDB();
    $product = $productDB->getProduct($product_id);

    include('product_view.php');
}
?>