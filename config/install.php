<?php
include("config.php");

$sql = "CREATE TABLE testTable
(id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
testField VARCHAR(75))";

$res = mysqli_query($db, $sql);
check_mysqli_error($db,$res);

?>