<?php

// retreieving entries from the database for the index lisitng
function entry_loop()
{
    require 'database.php';

    try {
        $results = $db->query('SELECT id, title, date
    FROM entries
    ORDER BY date DESC');
    } catch (Exception $e) {
        echo $e->getMessage();
        exit;
    }

    return $results;
}

// adding entries to the database
function add_entry($title, $date, $time, $learned, $resources)
{
    require 'database.php';

    $sql = 'INSERT INTO entries (title, date, time_spent, learned, resources) 
            VALUES (?,?,?,?,?)';

    try {
        $results = $db->prepare($sql);
        $results->bindValue(1, $title, PDO::PARAM_STR);
        $results->bindValue(2, $date, PDO::PARAM_STR);
        $results->bindValue(3, $time, PDO::PARAM_STR);
        $results->bindValue(4, $learned, PDO::PARAM_STR);
        $results->bindValue(5, $resources, PDO::PARAM_STR);
        $results->execute();
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }

    return true;
}

// edit entries in the database
function edit_entry($title, $date, $time, $learned, $resources, $id)
{
    require 'database.php';

    $sql = 'UPDATE entries
            SET title = ?, date = ?, time_spent = ?, learned = ?, resources =? 
            WHERE id = ?';

    try {
        $results = $db->prepare($sql);
        $results->bindValue(1, $title, PDO::PARAM_STR);
        $results->bindValue(2, $date, PDO::PARAM_STR);
        $results->bindValue(3, $time, PDO::PARAM_STR);
        $results->bindValue(4, $learned, PDO::PARAM_STR);
        $results->bindValue(5, $resources, PDO::PARAM_STR);
        $results->bindValue(6, $id, PDO::PARAM_INT);
        $results->execute();
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }

    return true;
}

// retreieving entries from the database for the detail single page
function get_entry_single($id)
{
    require 'database.php';

    $sql = 'SELECT title, date, time_spent, learned, resources
            From entries WHERE id = ?';

    try {
        $results = $db->prepare($sql);
        $results->bindValue(1, $id, PDO::PARAM_INT);
        $results->execute();
    } catch (Exception $e) {
        echo $e->getMessage();
        exit;
    }

    return $results->fetch();
}

// delete an entry 
function delete_entry($id)
{
    require 'database.php';

    $sql = 'DELETE FROM entries
            WHERE id = ?';

    try {
        $results = $db->prepare($sql);
        $results->bindValue(1, $id, PDO::PARAM_INT);
        $results->execute();
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }

    return true;
}
