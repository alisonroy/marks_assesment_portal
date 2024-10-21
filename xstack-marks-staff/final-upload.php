<?php
require "config.php";

$username = $_POST["username"];
$auth_token = $_POST["auth_token"];
$sql = "SELECT full_name,auth_token,user_type,department,isClassAdvisor,isManagement,semester,picture_url,section from users WHERE username = '$username'";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);
$validAuthToken = $row["auth_token"];
$userType = $row["user_type"];
$table = $_POST["table"];
if ($auth_token === $validAuthToken and $userType != "student") {
    $table = $_POST["table"];
    $column = $_POST["column"];
    $exam = $_POST["exam"];
    $op = $_POST["operation"];
    $tot = $_POST["total"];
    $totmark = $_POST["totmark"];
    $query = "SELECT `full_name`,`register_no`,`" . join("`,`", $column) . "` FROM users JOIN $table USING (register_no);";
    $tab = $conn->query($query);
    while ($row = $tab->fetch_assoc()) {
        $marks = 0;
        foreach ($column as $mark) {
            $marks += (int)$row[$mark];
        }
        if ($op == "sum") {
            $query = "UPDATE $table
            SET `$exam` = $marks
            WHERE (register_no=" . $row["register_no"] . ");";
            if ($conn->query($query)) {
            } else {
                echo json_encode("failed");
            }
        }
        if ($op == "average") {
            $avg = ($marks / $tot) * (int)$totmark;
            $query = "UPDATE $table
            SET `$exam` = $avg
            WHERE (register_no=" . $row["register_no"] . ");";
            if ($conn->query($query)) {
            } else {
                echo json_encode("failed");
            }
        }
    }
    echo json_encode("success");
} else {
    echo json_encode("false");
}

$conn->close();
