<?php
require_once('model/fields.php');
require_once('model/validate.php');

// Add fields with optional initial message
$validate = new Validate();
$fields = $validate->getFields();
$fields->addField('first_name');
$fields->addField('last_name');
$fields->addField('zip', 'Use valid 5 or 9 digit zip code.');
$fields->addField('credit_card', 'Must be a valid credit card based on the card type.');

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = 'reset';
} else {
    $action = strtolower($action);
}

switch ($action) {
    case 'reset':
        // Reset values for variables
        $first_name = '';
        $last_name = '';
        $zip = '';
        $credit_card = '';
        $cc_type ='';

        // Load view
        include 'view/payment.php';
        break;
    case 'payment':
        // Copy form values to local variables
        $first_name = trim(filter_input(INPUT_POST, 'first_name'));
        $last_name = trim(filter_input(INPUT_POST, 'last_name'));
        $zip = trim(filter_input(INPUT_POST, 'zip'));
        $credit_card = trim(filter_input(INPUT_POST, 'credit_card'));
        $cc_type = filter_input(INPUT_POST, 'cc_type');

        // Validate form data
        $validate->text('first_name', $first_name);
        $validate->text('last_name', $last_name);
        $validate->zip('zip', $zip); // Changed to zip validation
        $validate->creditcard('credit_card', $credit_card, $cc_type); // Changed to creditcard validation

        // Load appropriate view based on hasErrors
        if ($fields->hasErrors()) {
            include 'view/payment.php';
        } else {
            include 'view/success.php';
        }
        break;
}
?>