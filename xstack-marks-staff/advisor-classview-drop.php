<?php
require "config.php";

$username = $_POST["username"];
$auth_token = $_POST["auth_token"];
$sql = "SELECT auth_token,isClassAdvisor from users WHERE username = '$username'";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);
$validAuthToken = $row["auth_token"];
$classAdvisor = $row["isClassAdvisor"];

if ($auth_token === $validAuthToken and $classAdvisor == 1) {
    $dept = $_POST["department"];
    $sem = $_POST["semester"];
    $query = "SELECT subject_code,subject_name FROM xstackinternal.subject_list where department='$dept' and semester='$sem';";
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
