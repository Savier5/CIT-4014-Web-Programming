<!-- Savier Osman
11/14/2022
Modified the program to allow the user to modify a task and save it, and promote tasks. -->

<?php
//get tasklist array from POST
$task_list = filter_input(INPUT_POST, 'tasklist', 
        FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
if ($task_list === NULL) {
    $task_list = array();
    
//    add some hard-coded starting values to make testing easier
//    $task_list[] = 'Write chapter';
//    $task_list[] = 'Edit chapter';
//    $task_list[] = 'Proofread chapter';
}

//get action variable from POST
$action = filter_input(INPUT_POST, 'action');

//initialize error messages array
$errors = array();

//process
switch( $action ) {
    // Modified to add the tasks to the top of the list.
    case 'Add Task':
        $new_task = filter_input(INPUT_POST, 'newtask');
        if (empty($new_task)) {
            $errors[] = 'The new task cannot be empty.';
        } else {
            array_unshift($task_list, $new_task);
        }
        break;
    // Removes the task the first task of the list.
    case 'Remove Task':
        if (count($task_list) === 0) {
            $errors[] = 'There are no tasks in the task list.';
        } else {
            $temp_var = array_shift($task_list);
        }
        break;
    case 'Delete Task':
        $task_index = filter_input(INPUT_POST, 'taskid', FILTER_VALIDATE_INT);
        if ($task_index === NULL || $task_index === FALSE) {
            $errors[] = 'The task cannot be deleted.';
        } else {
            unset($task_list[$task_index]);
            $task_list = array_values($task_list);
        }
        break;
    case 'Modify Task':
        $task_index = filter_input(INPUT_POST, 'taskid', FILTER_VALIDATE_INT);
        if ($task_index === NULL || $task_index === FALSE) {
            $errors[] = 'The task cannot be modified.';
        } else {
           $task_to_modify = $task_list[$task_index];
        }
        break;
    case 'Save Changes':
        $i = filter_input(INPUT_POST, 'modifiedtaskid', FILTER_VALIDATE_INT);
        $modified_task = filter_input(INPUT_POST, 'modifiedtask');
        if (empty($modified_task)){
            $errors[] = 'The modified task cannot be empty.';
        } elseif ($i === NULL || $i === FALSE){
            $errors[] = 'The task cannot be modified.';
        } else {
            $task_list[$i] = $modified_task;
            $modified_task = '';
        }
        break;
    case 'Cancel Changes':
        $modified_task = '';
        break;
    
    case 'Promote Task':
        $task_index = filter_input(INPUT_POST, 'taskid', FILTER_VALIDATE_INT);
        if ($task_index === NULL || $task_index === FALSE) {
            $errors[] = 'The task cannot be promoted.';
        } elseif ($task_index == 0) {
            $errors[] = 'You can\'t promote the first task.';
        } else {
           // get the values for the two indexes
           $task_value = $task_list[$task_index];
           $prior_task_value = $task_list[$task_index - 1];

           // Swap the values
           $task_list[$task_index - 1] = $task_value;
           $task_list[$task_index] = $prior_task_value;
        }
        break;

    case 'Sort Tasks':
        sort($task_list);
        break;
    
    // Reverses the task list
    case 'Reverse Sort':
        rsort($task_list);
        break;

    // Searchs for the task, if it is not found or no input is provided, it gives an error.
    case 'Search Task':
        $searchtask = filter_input(INPUT_POST, 'searchtask');
        if (empty($searchtask)) {
            $message2 = 'Error: The task name is not provided. ';
        } elseif ( $task_list[array_search($searchtask, $task_list)] === $searchtask) {
            $message2 = "The task " . $task_list[array_search($searchtask, $task_list)] . " is found at task number " . (array_search($searchtask, $task_list) + 1);
        } else {
            $message2 = 'Error: The task is not found';
        }
        break;
    
}

include('task_list.php');
?>