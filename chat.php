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

// Write Messege :
echo "<br /><br /><h3>Write a messege :</h3>";
$sender='';
$reciver='';
$messege='';
 if (!empty($_POST['sender']))
{
	$sender=mysqli_real_escape_string($db,$_POST['sender']);
	$reciver=mysqli_real_escape_string($db,$_POST['reciver']);
	$messege=mysqli_real_escape_string($db,$_POST['messege']);
	$sql = "INSERT INTO messeges (sender,reciver,messege) VALUES ('".$sender."','".$reciver."','".$messege."')";
	echo $sql."<br />";
	$res = mysqli_query($db, $sql);
	check_mysqli_error($db,$res);
	echo "<h3>Added ! :</h3>";
}

// Read messeges :
echo "<br /><h3>Messeges :</h3>";
$sql = "SELECT * FROM messeges";
$res = mysqli_query($db, $sql);
check_mysqli_error($db,$res);
if ($res) {
	while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
		echo "'".$row['sender']."' Send a messege to '".$row['reciver']."' :	".$row['messege']."<br/>";
	}
}


?>
<form action="" method="post" >
	Sender:<input name="sender" type="text" value="<?php echo $sender ?>" size="12" />
	Reciver:<input name="reciver" type="text" value="<?php echo $reciver ?>" size="12" /> <br />
	Messege:<input name="messege" type="text" size="25" />
	<input type="submit" value="Send" />
</form>

<?php

?>