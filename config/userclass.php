<?php
include("userclass_lang_fa.php");

class user_class
{

 var $db;
 
function register($username,$password,$passverif,$email,$auto_active=0)
{
	//We check if the two passwords are identical
	if($password!=$passverif)
	{	//Otherwise, we say the passwords are not identical
		return userclass_lang_11;
	}
	
	//We check if the password has 6 or more characters
	if(strlen($password)<6)
	{	//Otherwise, we say the password is too short
		return userclass_lang_12;
	}
	
	/*
	/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/
	 Between Start -> ^
	 And End -> $
	 Starts with letter [a-z]+
	 of the string there has to be at least one number -> (?=.*\d)
	 and at least one letter -> (?=.*[A-Za-z])
	 and it has to be a number, a letter or one of the following: !@#$% -> [0-9A-Za-z!@#$%]
	 and there have to be 8-12 characters -> {8,12}
	 */
	if(!preg_match('/^[0-9A-Za-z!@#$%]{6,20}$/', $password)) {
		return userclass_lang_13;
	}
	
	//We check if the username form is valid
	/*
		/^[a-z0-9]{6,10}$/
	 Starts with letter [a-z]+
	Numbers from 0 - 9
	No capital letters
	no special symbols at all
	min of 6 characters 
	max of 10 characters
	*/
	
	if(!preg_match('/^[a-z]+[a-z0-9]{5,12}$/',$username))
	{
		//Otherwise, we say the username is not valid
		return userclass_lang_14;
	}
	
	//We check if the email form is valid
	if(!preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',$email))
	{
		//Otherwise, we say the email is not valid
		return userclass_lang_15;
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
	$res =mysqli_query($this->db,$sql);
	//check_mysqli_error($this->db,$res);
	if (!$res)
	{
		//Otherwise, we say that an error occured
		return userclass_lang_16;
	}
	
	$row = mysqli_num_rows($res);
	if($row>0)
	{	//Otherwise, we say the username is not available
		return userclass_lang_17;
	}
	
	
	if ($auto_active==0) // We Need activation code
	{
		generate_active_code:
		$auto_active=random_str(10); // 10 character activation code
		$sql = 'select id from users where active="'.$auto_active.'"';
		$res =mysqli_query($this->db,$sql);
		// check_mysqli_error($this->db,$res);
		if (!$res)
		{
			//Otherwise, we say that an error occured
			return userclass_lang_27;
		}
		$row = mysqli_num_rows($res);
		if($row>0)
		{	//Otherwise, we generate another code
			goto generate_active_code;
		}
	}else{
		$auto_active=null; // Means that accont is active !
	}
	//We save the informations to the databse
	$sql = 'insert into users(username, password, email, active, signup_date) values 
	("'.$username.'", "'.$password.'", "'.$email.'", "'.$auto_active.'", "'.time().'")';
	
	$res =mysqli_query($this->db,$sql);
	check_mysqli_error($this->db,$res);
	if($res)
	{
		return userclass_lang_mail_active ($username,$email,$auto_active);
		// Susses
		return TRUE;
	}
	else
	{
		//Otherwise, we say that an error occured
		return userclass_lang_18;
	}
}

function login($username,$password)
{
	if(!preg_match('/^[0-9A-Za-z!@#$%]{6,20}$/', $password))
		return userclass_lang_19;
	if(!preg_match('/^[a-z]+[a-z0-9]{5,12}$/',$username))
		return userclass_lang_20;
	
	//We get the password of the user
	$sql = 'select password,id from users where username="'.$username.'"';
	$res = mysqli_query($this->db, $sql);
		if (!$res)
			return FALSE;
	$row = mysqli_fetch_array($res);
	//We compare the submited password and the real one, and we check if the user exists
	if($row['password']==$password)
	{
		//We save the user name in the session username and the user Id in the session userid
		$_SESSION['username'] = $username;
		$_SESSION['userid'] = $row['id'];
		setcookie("user", $username,  time() + 36000);
		return TRUE;
	}
	else
	{
		//Otherwise, we say the password is incorrect.
		return userclass_lang_21;
	}
}

function islogin()
{
	if(isset($_SESSION['username']) and $_SESSION['username'] === $_COOKIE["user"])
		return TRUE;
	else
		return FALSE;
}

function update($id, $password='' ,$passverif='' ,$email='' ,$avatar='' ) //Should be contain all fileds ! + Can be a array (halesh nis !)
{
	//We check if the two passwords are identical
	if($password!='' and $password!=$passverif)
	{	//Otherwise, we say the passwords are not identical
		return userclass_lang_22;
	}
	
	//We check if the password has 6 or more characters
	if($password!='' and strlen($password)<6)
	{	//Otherwise, we say the password is too short
		return userclass_lang_23;
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
	if($password!='' and !preg_match('/^[a-z]+[0-9A-Za-z!@#$%]{6,20}$/', $password)) {
		return userclass_lang_24;
	}
	
	//We check if the email form is valid
	if($email!='' and !preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',$email))
	{
		//Otherwise, we say the email is not valid
		return userclass_lang_25;
	}
	
	$sql ="UPDATE users SET";
	$sql.=" id='".$id."'";
	if($password!='')
		$sql.=", password='".$password."'";
	if($email!='')
		$sql.=", email='".$email."'";
	if($avatar!='')
		$sql.=", avatar='".$avatar."'";
	$sql.=" WHERE id='".$id."'";
	$res = mysqli_query($this->db, $sql);
	if ($res)
	{
		// Susses
		return TRUE;
	}
	else
	{
		//Otherwise, we say that an error occured
		return userclass_lang_26;
	}
}

function getname($userid)
{
 if($userid='')
 {
	return $_SESSION['username'];
 }
}

function getid($username='')
{
	 if($username='')
	 {
		return $_SESSION['userid'];
	 }
}

function getavatar($userid='') // Can have problem ?
{
	if ($userid='')
		$userid=$this->getid();
	$sql = 'select avatar,id from users where id="'.$userid.'"';
	$res = mysqli_query($this->db, $sql);
	if ($res)
	{
		$row = mysqli_fetch_array($res);
		return $row['avatar'];
	}else{
		return FALSE;
	}
}

function getdetails($userid='')
{
	if ($userid='')
		$userid=$this->getid();
	$sql = 'select * from users where id="'.$userid.'"';
	$res = mysqli_query($this->db, $sql);
	if ($res)
	{
		return mysqli_fetch_array($res);
	/*	$id=$row['id'];
		$name=$row['username'];
		$email=$row['email'];
		$avatar=$row['avatar'];
		$signup_date=$row['signup_date'];
		return TRUE;
	*/
	}else{
		return FALSE;
	}
}


}
?>