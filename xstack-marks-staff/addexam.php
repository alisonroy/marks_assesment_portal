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
  $table = $_POST["table"];
  $column = $_POST["column"];
  $query = "ALTER TABLE $table 
  ADD COLUMN `$column` INT(11) NOT NULL ;";
  if ($conn->query($query)) {
    echo json_encode("success");
  } else {
    echo json_encode("failed");
  }
} else {
  echo json_encode("false");
}





$conn->close();
