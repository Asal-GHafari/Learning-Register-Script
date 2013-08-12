<?php
class user
{
var $name;  // User Name
var $id; // User ID
var $avatar; // User Avatar

function singup($username,$password,$passverif,$email)
{
	//We check if the two passwords are identical
	if($password!=$passverif)
	{	//Otherwise, we say the passwords are not identical
		return 'The passwords you entered are not identical.';
	}
	
	//We check if the password has 6 or more characters
	if(strlen($password)<6)
	{	//Otherwise, we say the password is too short
		return 'Your password must contain at least 6 characters.';
	}
	
	/*
	/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/
	 Between Start -> ^
	 And End -> $
	 of the string there has to be at least one number -> (?=.*\d)
	 and at least one letter -> (?=.*[A-Za-z])
	 and it has to be a number, a letter or one of the following: !@#$% -> [0-9A-Za-z!@#$%]
	 and there have to be 8-12 characters -> {8,12}
	 */
	if(!preg_match('/^[0-9A-Za-z!@#$%]{6,20}$/', $password)) {
		return 'the password does not meet the requirements!';
	}
	
	//We check if the username form is valid
	/*
		/^[a-z0-9]{6,10}$/
	Numbers from 0 - 9
	No capital letters
	no special symbols at all
	min of 6 characters 
	max of 10 characters
	*/
	
	if(!preg_match('/^[a-z0-9]{6,12}$/',$username))
	{
		//Otherwise, we say the username is not valid
		return 'The username you entered is not valid.';
	}
	
	//We check if the email form is valid
	if(!preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',$email))
	{
		//Otherwise, we say the email is not valid
		return 'The email you entered is not valid.';
	}
	
	//We protect the variables
	/*
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$avatar = $_POST['avatar'];
	*/
	
	//We check if there is no other user using the same username
	$sql = 'select id from users where username="'.$username.'"';
	$dn = mysqli_num_rows(mysqli_query($db,$sql));
	if($dn>0)
	{	//Otherwise, we say the username is not available
		return 'The username you want to use is not available, please choose another one.';
	}
	
	//We save the informations to the databse
	$sql = 'insert into users(username, password, email, signup_date) values 
	('.$username.'", "'.$password.'", "'.$email.'", "'.time().'")';
	if(mysqli_query($db,$sql))
	{
		// Susses
		return TRUE
	}
	else
	{
		//Otherwise, we say that an error occured
		return 'An error occurred while signing up.';
	}
}

function login($username,$password)
{
	if(!preg_match('/^[0-9A-Za-z!@#$%]{6,20}$/', $password))
		return 'the password does not meet the requirements!';
	if(!preg_match('/^[a-z0-9]{6,12}$/',$username))
		return 'The username you entered is not valid.';
	
	//We get the password of the user
	$sql = 'select password,id from users where username="'.$username.'"';
	$res = mysqli_query($db, $sql);
	$dn = mysqli_fetch_array($res);
	//We compare the submited password and the real one, and we check if the user exists
	if($dn['password']==$password)
	{
		//We save the user name in the session username and the user Id in the session userid
		$_SESSION['username'] = $username];
		$_SESSION['userid'] = $dn['id'];
		setcookie("user", $username,  time() + 36000);
		return TRUE;
	}
	else
	{
		//Otherwise, we say the password is incorrect.
		return 'The username or password is incorrect.';
	}
}

function islogin()
{
	if(isset($_SESSION['username']) and $_SESSION['username'] === $_COOKIE["user"])
		return TRUE;
}

}
?>