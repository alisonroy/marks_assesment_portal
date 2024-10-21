<?php
require "config.php";

$username = $_POST["username"];
$auth_token = $_POST["auth_token"];
$sql = "SELECT auth_token,user_type from users WHERE username = '$username'";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);
$validAuthToken = $row["auth_token"];
$userType = $row["user_type"];
$table = $_POST["table"];
if ($auth_token === $validAuthToken and $userType != "student") {
    $column = $_POST["column"];
    $markcol = $_POST["markset"];
    foreach ($markcol as $reg_no => $mark) {
        $query = "UPDATE $table
        SET `$column` = $mark
        WHERE (register_no=$reg_no);";
        if ($conn->query($query)) {
        } else {
            echo json_encode("failed");
        }
    }
    echo json_encode("success");
} else {
    echo json_encode("false");
}

$conn->close();
