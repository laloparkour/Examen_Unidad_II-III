<?php

    $dsn = 'mysql:dbname=examen_bd;host=localhost:3306';
    $username = 'root';
    $password = '';

    try {
        $conn = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        die('Connection Failed: ' . $e->getMessage());
    }


?>