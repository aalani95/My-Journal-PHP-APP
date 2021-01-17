<?php

// variables
$pageTitle = 'MyJournal';
$page = 'index';

// includes
require 'inc/functions.php';
require 'inc/globals.php';

echo $htmlHeader;
?>

<div class="entry-list">
<?php
// entries listing loop
foreach (entry_loop() as $entry) {
    echo '<article>
    <h2><a href="detail.php?id=' . $entry["id"] . '">' . $entry['title']. '</a></h2>';
    echo '<time datetime="' . $entry['date'] . '">' . date("F d, Y" ,strtotime($entry["date"])) . '</time>
    </article>';
}
?>
</div>

<?php

echo $htmlFooter;
?>