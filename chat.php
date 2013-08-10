<?php
// init Script :
include("config/config.php");
$sql = "CREATE TABLE messeges
(
id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
sender VARCHAR(15),
reciver VARCHAR(15),
messege VARCHAR(255)
)";
$res = mysqli_query($db, $sql);
check_mysqli_error($db,$res);

// Read messeges :
echo "<br /><br /><br /><br /><h1>Messeges :</h1>";
$sql = "SELECT * FROM messeges";
$res = mysqli_query($db, $sql);
check_mysqli_error($db,$res);
if ($res) {
	while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
		echo "'".$row['sender']."' Send a messege to '".$row['reciver']."' :	".$row['messege']."<br/>";
	}
}


?>