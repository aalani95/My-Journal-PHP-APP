<?php
// variables
$pageTitle = 'Add Journal';
$page = 'add';

// form fields
$title = $date = $time = $learned = $resources = '';

// includes
require 'inc/functions.php';
require 'inc/globals.php';

// new entry form post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // collect value of input field
  $title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
  $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);
  $time = trim(filter_input(INPUT_POST, 'timeSpent', FILTER_SANITIZE_STRING));
  $learned = trim(filter_input(INPUT_POST, 'whatILearned', FILTER_SANITIZE_STRING));
  $resources = trim(filter_input(INPUT_POST, 'ResourcesToRemember', FILTER_SANITIZE_STRING));


 // make sure the "*" fields are actually filled 
 if (empty($title) || empty($time) || empty($learned)) {
    $form_error = "Please fill in all the required (*) fields";
} else {
    if(add_entry($title, $date, $time, $learned, $resources)) {
        header('location: index.php');
    } else {
        $error_messsage = 'Error adding your Entry, please try again later!';
    }
}

}

echo $htmlHeader;
?>

    <div class="new-entry">
        <h2>New Entry</h2>
        <?php
        if (isset($form_error)) { 
        echo $form_error;
        }
        ?>
        <form method="post" action="">
            <label for="title"> Title*</label>
            <input id="title" type="text" name="title" value="<?php echo $title; ?>"><br>
            <label for="date">Date</label>
            <input id="date" type="date" name="date" value="<?php echo $date; ?>"><br>
            <label for="time-spent"> Time Spent*</label>
            <input id="time-spent" type="text" name="timeSpent" value="<?php echo $time; ?>"><br>
            <label for="what-i-learned">What I Learned*</label>
            <textarea id="what-i-learned" rows="5" name="whatILearned"><?php echo $learned; ?></textarea>
            <label for="resources-to-remember">Resources to Remember</label>
            <textarea id="resources-to-remember" rows="5" name="ResourcesToRemember"><?php echo $resources; ?></textarea>
            <input type="submit" value="Publish Entry" class="button">
            <a href="#" class="button button-secondary">Cancel</a>
        </form>
    </div>

<?php

echo $htmlFooter;
?>