<?php

$dbHost = 'localhost';
$dbUser = 'username';
$dbPass = 'password';
$dbName = 'test';

$mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

if ($result1 = $mysqli->query("SHOW TABLES FROM $dbName")) {
    if ($result1->num_rows > 0) {
        $tables = array();
        while ($obj = $result1->fetch_object()) {
            array_push($tables, $obj->{'Tables_in_' . $dbName});
        }
    }
}