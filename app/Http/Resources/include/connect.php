<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = 'rolan2';

try {
    $con = new PDO("mysql:host=$servername;dbname=rolan2", $username, $password);
    // set the PDO error mode to exception
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
