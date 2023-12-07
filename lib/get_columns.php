<?php

function get_columns($table)
{
    $table = se($table, null, null, false);
    $db = getDB();
    $query = "SHOW COLUMNS FROM $table"; //be sure you trust $table
    $stmt = $db->prepare($query);
    $results = [];
    try {
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        flash("Error, its not linked to a table, contact an admin for assistance", "danger");
        error_log("PDOExecption: " . $e->getMessage());
    }
    return $results;
}