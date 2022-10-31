<?php
    // Savier Osman
    // 10/25/2022

    // get Post data from form
    $product_description = $_POST["product_description"];
    $list_price = $_POST["list_price"];
    $discount_percent = $_POST["discount_percent"];

    // Validate Product Description
    if (empty($product_description)) {
        $error_message = 'There must be a product description.';
    // Validate list price
    } else if (empty($list_price))  {
        $error_message = 'List price must be a set to positive number.';
    } else if (!is_numeric($list_price))  {
        $error_message = 'List price must be a set to positive number.';
    } else if ($list_price <= 0)  {
        $error_message = 'List price must be a set to positive number.1';
    // Validate dicount percent
    } else if (empty($discount_percent))  {
        $error_message = 'Discount percent must be a set to positive number.';
    } else if (!is_numeric($discount_percent))  {
        $error_message = 'List price must be a set to positive number.';
    } else if ($discount_percent <= 0)  {
        $error_message = 'List price must be a set to positive number.2';
    // Set error message to empty string if no invalid entries
    } else {
        $error_message = ''; 
    }

    // if an error message exists, go to the index page
    if ($error_message != '') {
        include('index.php');
        exit();
    }

    // Calculate discounts
    $discount = $list_price * $discount_percent * .01;
    $discount_price = $list_price - $discount;
    // Calculates Sales Taxes and Total
    $sales_taxes_rate = 0.08;
    $sales_taxes = $sales_taxes_rate * $discount_price;
    $sales_total = $sales_taxes + $discount_price;

    //Formatting data
    $list_price_f = "$".number_format($list_price, 2);
    $discount_percent_f = $discount_percent."%";
    $discount_f = "$".number_format($discount, 2);
    $discount_price_f = "$".number_format($discount_price, 2);
    $sales_taxes_rate_f = $sales_taxes_rate * 100 ."%";
    $sales_taxes_f = "$".number_format($sales_taxes, 2);
    $sales_total_f = "$".number_format($sales_total, 2);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Product Discount Calculator</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <main>
        <h1>This page is under construction</h1>
        <label>Product Description:</label>
        <span><?php echo htmlspecialchars($product_description); ?></span><br>
        <label>List Price:</label>
        <span><?php echo htmlspecialchars($list_price_f); ?></span><br>
        <label>Standard Discount:</label>
        <span><?php echo htmlspecialchars($discount_percent_f); ?></span><br>
        <label>Discount Amount:</label>
        <span><?php echo $discount_f; ?></span><br>
        <label>Discount Price:</label>
        <span><?php echo $discount_price_f; ?></span><br><br>
        <label>Sales Tax Rate:</label>
        <span><?php echo $sales_taxes_rate_f; ?></span><br>
        <label>Sales Tax Amount:</label>
        <span><?php echo $sales_taxes_f; ?></span><br>
        <label>Sales Total:</label>
        <span><?php echo $sales_total_f; ?></span><br>
    </main>
</body>
</html>