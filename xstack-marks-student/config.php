<?php

header('Access-Control-Allow-Origin: *');
error_reporting(0);

$server = "sql205.epizy.com";
$username = "epiz_27947554";
$password = "vrvbrnqvxyV";
$db = "epiz_27947554_Test";

$conn = new mysqli($server, $username, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
