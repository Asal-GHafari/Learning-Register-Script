<?php
include("config/config.php");

$sql = "CREATE TABLE messege
(
id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
sender VARCHAR(15),
reciver VARCHAR(15),
messege VARCHAR(255)
)";
$res = mysqli_query($db, $sql);
check_mysqli_error($db,$res);



?>