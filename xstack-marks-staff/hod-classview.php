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
    $tables[] = array();
    foreach ($_POST["tables"] as $table) {
        $tables[] = $table;
    }
    $tables = json_encode($tables);
    $exam = $_POST["examcum"];
    $report_type = $_POST["type"];
    if ($report_type == "cummulative") {
        $cmd = "D:/home/python364x64/python.exe hod-classview-cummulative.py '$tables' '$exam'";
    }
    if ($report_type == "consolidated") {
        $exams[] = array();
        foreach ($_POST["examcon"] as $exam_con) {
            $exams[] = $exam_con;
        }
        $exams = json_encode($exams);
        $cmd = "D:/home/python364x64/python.exe hod-classview-consolidated.py '$tables' '$exams'";
    }
    $output = shell_exec($cmd);
    echo json_encode($output);
} else {
    echo json_encode("false");
}
