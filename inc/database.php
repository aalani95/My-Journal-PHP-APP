<?php

// establishing connection with sqlite database.
try {
$db = new PDO('sqlite:' . __DIR__ . '/journal.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
    echo $e->getMessage();
    die();
}