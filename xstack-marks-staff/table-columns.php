<?php
require "config.php";

$username = $_POST["username"];
$auth_token = $_POST["auth_token"];
$sql = "SELECT auth_token,user_type from users WHERE username = '$username'";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);
$validAuthToken = $row["auth_token"];
$userType = $row["user_type"];
if ($auth_token === $validAuthToken and $userType != "student") {
    $tables = $_POST["table"];
    foreach ($tables as $table) {
        $query = "SHOW COLUMNS FROM `$table` ;";
        $tab = $conn->query($query);
        $data[] = array();
        while ($row = $tab->fetch_assoc()) {
            $data[] = $row["Field"];
        }
    }
    echo json_encode($data);
} else {
    echo json_encode("false");
}

$conn->close();
