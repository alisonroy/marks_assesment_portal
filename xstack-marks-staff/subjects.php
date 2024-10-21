<?php
require "config.php";

$username = $_POST["username"];
$auth_token = $_POST["auth_token"];
$sql = "SELECT auth_token,user_type from users WHERE username = '$username'";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);
$validAuthToken = $row["auth_token"];
$userDept = $row["user_type"];

if ($auth_token === $validAuthToken and $userType != "student") {
    $query = "SELECT DISTINCT T.subject_name, subject_abbr,subject_code,subCode_dept_sem,subject_type,T.semester,department FROM time_table AS T JOIN subject_list USING (subject_code,department) where staff_name= '$username' ;";
    $tab = $conn->query($query);
    $data[] =  array();
    while ($row = $tab->fetch_assoc()) {
        switch ($row["department"]) {
            case "dit":
                $row["department"] = "IT";
                break;
            case "dcse":
                $row["department"] = "CSE";
                break;
            case "dece":
                $row["department"] = "ECE";
                break;
            case "deee":
                $row["department"] = "EEE";
                break;
            case "dmea":
                $row["department"] = "MECH A";
                break;
            case "dmeb":
                $row["department"] = "MECH B";
                break;
        }
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo json_encode("false");
}



$conn->close();
