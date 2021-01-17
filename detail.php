<?php

// variables
$pageTitle = 'Journal Detail';
$page = 'detail';
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

// includes
require 'inc/functions.php';
require 'inc/globals.php';

$entry = get_entry_single($id);

// capture post request from "Delete form"
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = filter_input(INPUT_POST, 'delete', FILTER_SANITIZE_NUMBER_INT);
    if (delete_entry($id)) {
        header('location: index.php');
        exit;
    } else {
        echo "Error Deleteing Item!";
        exit;
    }
}

echo $htmlHeader;
?>

<div class="entry-list single">
    <article>
        <h1><?php echo $entry['title']; ?></h1>
        <time datetime="<?php echo $entry['date']; ?>"><?php echo date("F d, Y" ,strtotime($entry["date"])); ?></time>
        <div class="entry">
            <h3>Time Spent: </h3>
            <p><?php echo $entry['time_spent']; ?></p>
        </div>
        <div class="entry">
            <h3>What I Learned:</h3>
            <p><?php echo $entry['learned']; ?></p>
        </div>
        <div class="entry">
            <h3>Resources to Remember:</h3>
            <ul>
                <?php echo $entry['resources']; ?>
            </ul>
        </div>
    </article>
</div>
<div class="edit">
    <p><a href="edit.php?id=<?php echo $id; ?>">Edit Entry</a></p>
        <form class="delete" method="post" action="detail.php">
            <input type="hidden" name="delete" value="<?php echo $id; ?>">
            <input type="submit" value="Delete">
        </form>
</div>

<?php

echo $htmlFooter;
?>