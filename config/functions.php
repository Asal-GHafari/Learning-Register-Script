<?php

function check_mysqli_error($db,$res=null) {
	if ( is_null($res)==FALSE){
		if($res==FALSE)
			echo("ERROR: ".mysqli_error($db)."<br />");
		else
			echo("NoProblem ;) <br />");
	}else{
		if (mysqli_connect_errno()) {
			echo("Connect failed: ".mysqli_connect_error()."<br />");
		} else {
			echo("Host information: ".mysqli_get_host_info($db)."<br />");
		}
	}
}

function random_str($length = 10) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, strlen($characters) - 1)];
	}
	return $randomString;
}

?>