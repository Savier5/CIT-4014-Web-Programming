<?php

// Savier Osman
// 11/29/2022
// Added a cookie to hold the data for 1 year rather than set it to an array.
// Modified the program to work with the array.

$lifetime = 60 * 60 * 24 * 365; // Set cookie for 1 years
session_set_cookie_params($lifetime, '/');
session_start();

// Get the array of tasks from the session
if (isset($_SESSION['tasklist'])) {
    $task_list = $_SESSION['tasklist'];
}else {
    $task_list = array();
}


$action = filter_input(INPUT_POST, 'action');
$errors = array();

switch( $action ) {
    case 'add':
        $new_task = filter_input(INPUT_POST, 'newtask');
        if (empty($new_task)) {
            $errors[] = 'The new task cannot be empty.';
        } else {
            $task_list[] = $new_task;
        }
        break;
    case 'delete':
        $task_index = filter_input(INPUT_POST, 'taskid', FILTER_VALIDATE_INT);
        if ($task_index === NULL || $task_index === FALSE) {
            $errors[] = 'The task cannot be deleted.';
        } else {
            unset($task_list[$task_index]);
            $task_list = array_values($task_list);
        }
        break;
}

// Set the array of task in the session
$_SESSION['tasklist'] = $task_list;

include('task_list.php');
?>