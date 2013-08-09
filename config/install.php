<?php
include("config.php");

$sql = "CREATE TABLE testTable
(id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
testField VARCHAR(75))";
$res = mysqli_query($db, $sql);
check_mysqli_error($db,$res);

// Write data :
$safestr=mysqli_real_escape_string($db," ' An 'Not Safe' String ! ' ");
$sql = "INSERT INTO testTable (testField) VALUES ('".$safestr."')";
echo($safestr);
$res = mysqli_query($db, $sql);
check_mysqli_error($db,$res);



?>