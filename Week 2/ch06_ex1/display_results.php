<?php
// Savier Osman
// 10/31/2022
// Modified program to include echo statement for tracing program for debugging purpose.

    // get the data from the form
    $investment = filter_input(INPUT_POST, 'investment', 
            FILTER_VALIDATE_FLOAT);
    $interest_rate = filter_input(INPUT_POST, 'interest_rate', 
            FILTER_VALIDATE_FLOAT);
    $years = filter_input(INPUT_POST, 'years', 
            FILTER_VALIDATE_INT);

    echo '$investment: ' . $investment . '<br>';
    echo '$interest_rate: ' . $interest_rate . '<br>';
    echo '$years: ' . $years . '<br>';

    // validate investment
    if ( $investment === NULL || $investment === FALSE ) {
        echo 'investment NULL or Fall: <br>';
        $error_message = 'Investment must be a valid number.'; }
    else if ( $investment <= 0 ) {
        echo 'investment less than zero: <br>';
        $error_message = 'Investment must be greater than zero.'; }

    // validate interest rate
    else if ( $interest_rate === NULL || $interest_rate === FALSE ) {
        echo 'investment rate NULL or Fall: <br>';
        $error_message = 'Interest rate must be a valid number.'; }
    else if ( $interest_rate <= 0 ) {
        echo 'investment rate less than zero: <br>';
        $error_message = 'Interest rate must be greater than zero.'; }
        
    // validate years
    else if ( $years === NULL || $years === FALSE ) {
        echo 'years NULL or Fall: <br>';
        $error_message = 'Number of years must be a valid whole number.'; }
    else if ( $years <= 0 ) {
        echo 'years less than zero: <br>';
        $error_message = 'Numbr of years must be greater than zero.'; }

    // set error message to empty string if no invalid entries
    else {
        $error_message = ''; }

    // if an error message exists, go to the index page
    if ($error_message != '') {
        echo 'Error message set: Returing to Index <br>';
        include('index.php');
        exit();
    }

    // calculate the future value
    $future_value = $investment;
    for ($i = 1; $i <= $years; $i++) {
        $future_value += $future_value * $interest_rate;
        echo '$i' . $i . '<br>';
        echo '$future_values: ' . $future_value . '<br>';
    }

    // apply currency and percent formatting
    $investment_f = '$'.number_format($investment, 2);
    $yearly_rate_f = $interest_rate.'%';
    $future_value_f = '$'.number_format($future_value, 2);
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
    </main>
</body>
</html>