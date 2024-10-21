<?php
require "config.php";

$username = $_POST["username"];
$auth_token = $_POST["auth_token"];
$sql = "SELECT auth_token,user_type from users WHERE username = '$username'";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);
$validAuthToken = $row["auth_token"];
$userType = $row["user_type"];
if ($auth_token === $validAuthToken  and $userType != "student") {
    $table = $_POST["table"];
    $column = $_POST["column"];
    $query = "SELECT full_name,register_no, `$column` FROM users JOIN $table USING (register_no);";
    $tab = $conn->query($query);
    $data[] = array();
    while ($row = $tab->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo json_encode("false");
}

$conn->close();
