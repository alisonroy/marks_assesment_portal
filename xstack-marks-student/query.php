<?php

include "config.php";

$name = $_POST["name"];
$age = $_POST["age"];

$sql = "UPDATE users SET age = '$age' WHERE full_name = '$name'";

$finalresult = array();

if($conn->query($sql)) {
    echo json_encode("success");
}
else {
    echo json_encode("failed");
}