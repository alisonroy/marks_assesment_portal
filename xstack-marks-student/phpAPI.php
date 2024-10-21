<?php

// require_once 'config.php';
// error_reporting(0);

// // get values from client, add additional POST vars here
// $username = $_POST["username"];
// $auth_token = $_POST["auth_token"];

// getting auth_token - to check user auth
// modify SQL script to suit your DB structure
// $sql = "SELECT auth_token, user_type from users WHERE username = '$username'";
// $result = $conn->query($sql);
// $row = mysqli_fetch_assoc($result);
// $validAuthToken = $row["auth_token"];
// $user_type = $row["user_type"];

// check auth here, check for user_type or any additional auth parameters in this block
// if($auth_token === $validAuthToken) {

// write any PHP block here

// use this to call a Python script -->
$command = escapeshellcmd("!D:/home/python364x86/python.exe !D:/home/site/wwwroot/xstack-marks-student/pythonmm.py");
$output = shell_exec($command);
echo $output;
// }
// else {
//     echo json_encode("invalid-auth-token");
// }

// $conn->close();