<?php
include("config/config.php");

$sql = "CREATE TABLE testTable
(id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
testField VARCHAR(75))";
$res = mysqli_query($db, $sql);
check_mysqli_error($db,$res);

// Write data :
echo "<br />Write Data :<br />";
$safestr=mysqli_real_escape_string($db," ' An 'Not Safe' String ! ' ");
$sql = "INSERT INTO testTable (testField) VALUES ('".$safestr."')";
$res = mysqli_query($db, $sql);
check_mysqli_error($db,$res);

// Read data :
echo "<br />Read Data :<br />";
$sql = "SELECT * FROM testTable";
$res = mysqli_query($db, $sql);
check_mysqli_error($db,$res);
echo "The Number of Rows is : ".mysqli_num_rows($res)."<br />";
if ($res) {
	while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
		echo "The ID is ".$row['id']." and the text is: ".$row['testField']."<br/>";
	}
}
mysqli_free_result($res); //cleaning the result {For More RAM space !}

//Delete the Table Data !
echo "<br />Delete Data :<br />";
$sql = "DELETE FROM `mg_test`.`testtable` ;";
$res = mysqli_query($db, $sql);
check_mysqli_error($db,$res);

?>