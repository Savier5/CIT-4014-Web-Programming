<?php
    require("future_value.php");

    // get the data from the form
    $investment = filter_input(INPUT_POST, 'investment', 
            FILTER_VALIDATE_FLOAT);
    $interest_rate = filter_input(INPUT_POST, 'interest_rate', 
            FILTER_VALIDATE_FLOAT);
    $years = filter_input(INPUT_POST, 'years', 
            FILTER_VALIDATE_INT);
    $compund_monthly = filter_input(INPUT_POST, 'compund_monthly', FILTER_VALIDATE_INT);

    // Creates new future_value object.
    $future_value_o = new future_value(); 

    //Sets values for the future_value object.
    $future_value_o->setInvestment($investment);
    $future_value_o->setInterestRate($interest_rate);
    $future_value_o->setYears($years);

    // Checks to see if $compund_monthly is set and sets the corrent boolean value.
    if (isset($compund_monthly)) {
        $compund_monthly = true;
    }else {
        $compund_monthly = false;
    }

    //Sets compund monthly value for the future_value object.
    $future_value_o->setCompundMonthly($compund_monthly);

    // Gets the error messsage if there are any
    $error_message = $future_value_o->validate($investment, $interest_rate, $years);
    
    // apply currency and percent formatting
    $investment_f = $future_value_o->getInvestmentFormatted();
    $yearly_rate_f = $future_value_o->getInterestRateFormatted();
    $future_value_f = $future_value_o->getFutureValueFormatted();
    $compund_monthly_f = $future_value_o->getCompoundMonthlyFormatted();

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
        <span><?php echo $compund_monthly_f; ?></span><br> <!-- Changed the variable name -->
    </main>
</body>
</html>