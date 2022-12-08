<?php include 'header.php'; ?>
<main>
    <h2>Success</h2>
    <p>The following registration information has been successfully
       submitted.</p>
    <ul>
        <li>First Name: <?php echo htmlspecialchars($first_name); ?></li>
        <li>Last Name: <?php echo htmlspecialchars($last_name); ?></li>
        <li>Zip Code: <?php echo htmlspecialchars($zip); ?></li>
        <li>Credit Card: <?php echo htmlspecialchars($credit_card); ?></li>
    </ul>
</main>
<?php include 'footer.php'; ?>