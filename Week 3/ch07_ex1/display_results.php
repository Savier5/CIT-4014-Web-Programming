<?php
    // Savier Osman
    // 11/7/2022
    // Modified program to process and display POST values

    // get the data from the form
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'password');
    $phone = filter_input(INPUT_POST, 'phone');

    // get the rest of the data for the form

    // for the heard_from radio buttons,
    // display a value of 'Unknown' if the user doesn't select a radio button
    $heard_from = filter_input(INPUT_POST, 'heard_from');
    if ($heard_from === NULL) {
        $heard_from = 'Unknown';
    }

    // for the wants_updates check box,
    // display a value of 'Yes' or 'No'
    $wants_updates = $_POST['wants_updates'];
    if (isset($wants_updates)) {
        $wants_updates = 'Yes';
    }else {
        $wants_updates = 'No';
    }

    $contact_via = filter_input(INPUT_POST, 'contact_via');

    $comments = filter_input(INPUT_POST, 'comments');
    $comments = htmlspecialchars($comments); // NOTE: You must code htmlspecialchars before nl2br for this to work correctly
    $comments = nl2br($comments, false);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Account Information</title>
    <link rel="stylesheet" type="text/css" href="main.css"/>
</head>
<body>
    <main>
        <h1>Account Information</h1>

        <label>Email Address:</label>
        <span><?php echo htmlspecialchars($email); ?></span><br>

        <label>Password:</label>
        <span><?php echo htmlspecialchars($password); ?></span><br>

        <label>Phone Number:</label>
        <span><?php echo htmlspecialchars($phone); ?></span><br>

        <label>Heard From:</label>
        <span><?php echo htmlspecialchars($heard_from); ?></span><br>

        <label>Send Updates:</label>
        <span><?php echo ($wants_updates); ?></span><br>

        <label>Contact Via:</label>
        <span><?php echo htmlspecialchars($contact_via); ?></span><br><br>

        <span>Comments:</span><br>
        <span><?php echo ($comments); ?></span><br>        
    </main>
</body>
</html>