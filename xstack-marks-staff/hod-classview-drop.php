<?php
require "config.php";

$username = $_POST["username"];
$auth_token = $_POST["auth_token"];
$sql = "SELECT auth_token,user_type from users WHERE username = '$username'";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);
$validAuthToken = $row["auth_token"];
$userType = $row["user_type"];
if ($auth_token === $validAuthToken and $userType == "hod") {
    $dept = $_POST["department"];
    $sem1 = $_POST["semester1"];
    $sem2 = $_POST["semester2"];
    $query = "SELECT subject_code,subject_name,semester FROM xstackinternal.subject_list where department='$dept' and (semester='$sem1' or semester='$sem2');";
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
