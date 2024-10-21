<?php
require "config.php";

$username = $_POST["username"];
$auth_token = $_POST["auth_token"];
$sql = "SELECT auth_token,user_type,department,isClassAdvisor,isManagement,semester,section from users WHERE username = '$username'";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);
$validAuthToken = $row["auth_token"];
$user_type = $row["user_type"];
if ($auth_token === $validAuthToken && $user_type != "student") {
    echo json_encode($row);
} else {
    echo json_encode("false");
}
$conn->close();
