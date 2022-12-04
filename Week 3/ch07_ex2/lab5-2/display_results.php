<?php

    // Savier Osman
    // 12/03/2022
    // Modified the program to require and use functions.php to call and use the different functions like
    // calculate_future_value(), get_currency_format(), and get_percentage_format().

    require "functions.php";

    // get the data from the form
    $investment = filter_input(INPUT_POST, 'investment', FILTER_VALIDATE_FLOAT);
    $interest_rate = filter_input(INPUT_POST, 'interest_rate', FILTER_VALIDATE_FLOAT);
    $years = filter_input(INPUT_POST, 'years', FILTER_VALIDATE_INT);
    $compund_monthly = filter_input(INPUT_POST, 'compund_monthly', FILTER_VALIDATE_INT);

    if (isset($compund_monthly)) {
        $compund_monthly = true;
    }else {
        $compund_monthly = false;
    }

    // validate investment
    if ($investment === FALSE ) {
        $error_message = 'Investment must be a valid number.'; 
    } else if ( $investment <= 0 ) {
        $error_message = 'Investment must be greater than zero.'; 
    // validate interest rate
    } else if ( $interest_rate === FALSE )  {
        $error_message = 'Interest rate must be a valid number.'; 
    } else if ( $interest_rate <= 0 ) {
        $error_message = 'Interest rate must be greater than zero.'; 
    // validate years
    } else if ( $years === FALSE ) {
        $error_message = 'Years must be a valid whole number.';
    } else if ( $years <= 0 ) {
        $error_message = 'Years must be greater than zero.';
    } else if ( $years > 30 ) {
        $error_message = 'Years must be less than 31.';
    // set error message to empty string if no invalid entries
    } else {
        $error_message = ''; 
    }

    // if an error message exists, go to the index page
    if ($error_message != '') {
        include('index.php');
        exit();
    }

    // Uses the calculate_future_value to get and set the $future_value
    $future_value = calculate_future_value($investment, $interest_rate, $years, $compund_monthly);

    // Sets the $compund_monthly to output 'Yes' or 'No' depending on if the Compound Interest Monthly is checked.
    if ($compund_monthly === true) {
        $compund_monthly = 'Yes';
    }else {
        $compund_monthly = 'No';
    }

    // Apply currency and percent formatting with functions
    $investment_f = get_currency_format($investment);
    $yearly_rate_f = get_percentage_format($interest_rate);
    $future_value_f = get_currency_format($future_value);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Future Value Calculator</title>
    <link rel="stylesheet" type="text/css" href="main.css"/>
</head>
<body>
    <main>
        <h1>Future Value Calculator</h1>

        <label>Investment Amount:</label>
        <span><?php echo $investment_f; ?></span><br>

        <label>Yearly Interest Rate:</label>
        <span><?php echo $yearly_rate_f; ?></span><br>

        <label>Number of Years:</label>
        <span><?php echo $years; ?></span><br>

        <label>Future Value:</label>
        <span><?php echo $future_value_f; ?></span><br>

        <label>Compund Monthly:</label>
        <span><?php echo $compund_monthly; ?></span><br>
    </main>
</body>
</html>