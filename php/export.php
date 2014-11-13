<?php

$dbHost = 'localhost';
$dbUser = 'username';
$dbPass = 'password';
$dbName = 'test';

///////////////////////////////////////////////////////////
$sql = '';

$mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
$mysqli->set_charset("utf8");

if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$result1 = $mysqli->query('SHOW TABLES FROM ' . $dbName);
if ($result1) {
    if ($result1->num_rows > 0) {
        $tables = array();
        while ($obj = $result1->fetch_row()) {
            array_push($tables, $obj[0]);
        }

        if (count($tables) > 0) {
            foreach ($tables as $table) {
                $result2 = $mysqli->query('SHOW CREATE TABLE ' . $table);
                $obj = $result2->fetch_row();

                $sql .= "\n\n" . '-- Table: ' . $table . "\n\n";
                $sql .= 'DROP TABLE ' . $table . ';' . "\n\n";
                $sql .= $obj[1] . "\n\n";

                $result3 = $mysqli->query('SELECT * FROM ' . $table);
                $fields = $result3->field_count;
                $rows = $result3->num_rows;

                $sql .= 'INSERT INTO ' . $table . ' VALUES ' . "\n";

                $row = 0;
                while ($obj = $result3->fetch_row()) {
                    $sql .= '(';
                    for ($i = 0; $i < $fields; $i++) {
                        $sql .= '\'' . $obj[$i] . '\'';
                        if ($i != $fields - 1) {
                            $sql .= ',';
                        }
                    }
                    $sql .= ')';
                    if ($row != $rows - 1) {
                        $sql .= ',';
                    } else {
                        $sql .= ';';
                    }
                    $sql .= "\n";
                    ++$row;
                }
            }
        } else {
            $sql .= 'No tables found';
        }
    }
}

$handle = fopen($dbName . '-backup-' . time() . '.sql', 'w+');
fwrite($handle, $sql);
fclose($handle);

header('Content-Type: text/plain; charset=utf-8');
echo $sql;
