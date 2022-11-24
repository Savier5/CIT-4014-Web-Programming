<?php

// Savier Osman
// 11/07/2022
// Updated program to validate input and format display message

//set default values
$name = '';
$email = '';
$phone = '';
$message = 'Enter some data and click on the Submit button.';

//process
$action = filter_input(INPUT_POST, 'action');

switch ($action) {
    case 'process_data':
        $name = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'email');
        $phone = filter_input(INPUT_POST, 'phone');

        /*************************************************
         * validate and process the name
         ************************************************/
        // 1. make sure the user enters a name
        // 2. display the name with only the first letter capitalized

        // Trim the spaces from the start and end of all data
        $name = trim($name);
        $email = trim($email);
        $phone = trim($phone);

        // Validate name
        if (empty($name)){
            $message = 'You must enter a name';
            break;
        }
        
        // Capitalize the first letters only
        $name = strtolower($name);
        $name = ucwords($name);

        // Get Full name from complete name
        $name_count = substr_count($name," ");
        $middle_name = null;//sets first and last name null incase they are not set by the user
        $last_name = null;
        $i = strpos($name, ' ');
        if ($name_count === 0) { // Grabs the first
            $first_name = $name;

            // Puts all the letters to lowercase 
            $first_name = strtolower($first_name);

            // Then turns the first letters to uppercase
            $first_name = ucfirst($first_name);
        }else if ($name_count === 1){ // Grabs the first, and last name
            $first_name = substr($name, 0 , $i);
            $last_name = substr($name, $i , strlen($name));

            // Puts all the letters to lowercase 
            $first_name = strtolower($first_name);
            $last_name = strtolower($last_name);

            // Then turns the first letters to uppercase
            $first_name = ucfirst($first_name);
            $last_name = ucfirst($last_name);
        }else if ($name_count === 2){ // Grabs the first, middle, and last name
            $first_name = substr($name, 0 , $i);
            $middle_name = substr($name, $i+1 , strlen($name));
            $temp_name = substr($name, $i+1 , strlen($name));
            $i = strpos($middle_name, ' ');
            $middle_name = substr($middle_name, 0 , $i);
            $last_name = substr($temp_name, $i+1 , strlen($temp_name));

            // Puts all the letters to lowercase 
            $first_name = strtolower($first_name);
            $middle_name = strtolower($middle_name);
            $last_name = strtolower($last_name);

            // Then turns the first letters to uppercase
            $first_name = ucfirst($first_name);
            $middle_name = ucfirst($middle_name);
            $last_name = ucfirst($last_name);
        }

        // ucfirst, 
        /*************************************************
         * validate and process the email address
         ************************************************/
        // 1. make sure the user enters an email
        // 2. make sure the email address has at least one @ sign and one dot character

        // Validate email
        if (empty($email)){
            $message = 'You must enter an email address.';
            break;
        } else if (strpos($email, '@') === false){
            $message = 'The email address must contain an @ sign.';
            break;
        } else if (strpos($email, '.') === false){
            $message = 'The email address must contain a dot character.';
            break;
        }

        /*************************************************
         * validate and process the phone number
         ************************************************/
        // 1. make sure the user enters at least seven digits, not including formatting characters
        // 2. format the phone number like this 123-4567 or this 123-456-7890

        // Remove common formatting characters from the phone number
        $phone = str_replace('-', '', $phone);
        $phone = str_replace('(', '', $phone);
        $phone = str_replace(')', '', $phone);
        $phone = str_replace(' ', '', $phone);
        $phone = str_replace('.', '', $phone);

        // Validate phone number
        if (strlen($phone) < 7){
            $message = 'The phone number must contain at least seven digits.';
            break;
        }

        // Format the phone number
        if (strlen($phone) == 7){
            $part1 = substr($phone, 0, 3);
            $part2 = substr($phone, 3);
            $phone = $part1 . '-' . $part2;
            $area_code = null;
        }else if (strlen($phone) == 10){
            $area_code = substr($phone, 0, 3);
            $part1 = substr($phone, 3, 3);
            $part2 = substr($phone, 6);
            $phone = $part1 . '-' . $part2;
        } else {
            $message = 'Invalid number of digits entered for the phone number';
            break;
        }

        /*************************************************
         * Display the validation message
         ************************************************/

        // Displays the first part of the message
        $message = "Hello $first_name, \n\n" .
        "Thank you for entering the data:\n\n" .
        "Name: $name\n" .
        "Email: $email\n" .
        "First Name: $first_name";

        if ($middle_name !== null) {
            $message .= "\nMiddle Name: $middle_name";
        }

        if ($last_name !== null) {
            $message .= "\nLast Name: $last_name";
        }

        if ($area_code !== null) {
            $message .= "\n\nArea code: $area_code\n" . "Phone number: $phone\n";
            break;
        }else {
            $message .= "\n\nPhone number: $phone\n";
            break;
        }
}
include 'string_tester.php';
?>