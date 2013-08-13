<?php
include("config/config.php");
?>

<h1>Register</h1>
<?php
if (isset($_POST['uname']) and isset($_POST['pass']) and isset($_POST['pass_ver']) and isset($_POST['email']))
{
	$res=$user->register($_POST['uname'],$_POST['pass'],$_POST['pass_ver'],$_POST['email']);
	if ($res===TRUE)
	{
		echo 'Registered succesfull !';
		echo '<br />';
	}else{
		echo 'ERROR: ';
		echo $res;
		echo '<br />';
	}
}
?>
<form action="register.php" method="post" >
username: <input type="text" name="uname" /> <br />
password: <input type="text" name="pass" /> <br />
repeat password: <input type="text" name="pass_ver" /> <br />
email:  <input type="text" name="email" /> <br />
<input type="submit" value="Register" />
</form>