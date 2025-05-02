<?php
$dbname = "mysql:host=localhost;dbname=todo";
$dbuser = "root";
$dbpass = "";
session_start();
try {
    $conn = new PDO($dbname, $dbuser, $dbpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
}
