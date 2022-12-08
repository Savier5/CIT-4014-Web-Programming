<?php

    // Savier Osman
    // 12/03/2022
    // Modified the program to use the data from the previous session,
    // if there are no values set from the previous session, the default
    // values are set and an expiration date of 2 weeks is set.

    // Start session management cookie
    $lifetime = 60 * 60 * 24 * 14; // Set cookie for 14 days
    session_set_cookie_params($lifetime, '/');
    session_start();

    // Get the array of values from the session if they are set
    if (!isset($_SESSION['calvalues'])) {
        // Creates an array and set default value of variables for initial page load
        $investment = '';
        $interest_rate = '';
        $years = '';
        $_SESSION['calvalues'] = array('investment' => $investment, 'interest_rate' => $interest_rate, 'years' => $years);
    }else {
        // Get the array of values from the session and sets them to the local variables
        $cal_values = $_SESSION['calvalues'];
        $investment = $cal_values['investment'];
        $interest_rate = $cal_values['interest_rate'];
        $years = $cal_values['years'];
    }
?> 
<!DOCTYPE html>
<html>
<head>
    <title>Future Value Calculator</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<body>
    <main>
    <h1>Future Value Calculator</h1>
    <?php if (!empty($error_message)) { ?>
        <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
    <?php } ?>
    <form action="display_results.php" method="post">

        <div id="data">
            <label>Investment Amount:</label>
            <input type="text" name="investment"
                   value="<?php echo htmlspecialchars($investment); ?>">
            <br>

            <label>Yearly Interest Rate:</label>
            <input type="text" name="interest_rate"
                   value="<?php echo htmlspecialchars($interest_rate); ?>">
            <br>

            <label>Number of Years:</label>
            <input type="text" name="years"
                   value="<?php echo htmlspecialchars($years); ?>">
            <br>
        </div>

        <div id="buttons">
            <label>&nbsp;</label>
            <input type="submit" value="Calculate"><br>
        </div>

    </form>
    </main>
</body>
</html>