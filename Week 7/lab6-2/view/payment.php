<?php include 'header.php'; ?>
<main>
    <form action="." method="post" >
    <fieldset>
        <legend>Credit Card Information</legend>
        
        <label>First Name:</label>
        <input type="text" name="first_name" 
               value="<?php echo htmlspecialchars($first_name);?>">
        <?php echo $fields->getField('first_name')->getHTML(); ?><br>

        <label>Last Name:</label>
        <input type="text" name="last_name" 
               value="<?php echo htmlspecialchars($last_name);?>">
        <?php echo $fields->getField('last_name')->getHTML(); ?><br>

        <label>Zip:</label>
        <input type="text" name="zip" 
               value="<?php echo htmlspecialchars($zip);?>">
        <?php echo $fields->getField('zip')->getHTML(); ?><br>

        <label>Credit Card:</label>
        <input type="text" name="credit_card" 
               value="<?php echo htmlspecialchars($credit_card);?>">
        <?php echo $fields->getField('credit_card')->getHTML(); ?><br>

        <label>Credit Card Type:</label>
        <input type="radio" id="visa" name="cc_type" value="visa" <?php if ($cc_type == 'visa') echo 'checked';?>>Visa
        <input type="radio" id="mastercard" name="cc_type" value="mastercard" <?php if ($cc_type == 'mastercard') echo 'checked';?>>Master Card
        <input type="radio" id="amex" name="cc_type" value="amex" <?php if ($cc_type == 'amex') echo 'checked';?>>American Express
    </fieldset>
    <fieldset>
        <legend>Submit Payment</legend>
        
        <label>&nbsp;</label>
        <input type="submit" name="action" value="Payment"/>
        <input type="submit" name="action" value="Reset" /><br>
    </fieldset>
    </form>
</main>
<?php include 'footer.php'; ?>