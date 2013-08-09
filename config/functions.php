<?php
function check_mysqli_error($db,$res=TRUE) {
	if ($res== FALSE){
		echo("ERROR: ".mysqli_error($db)."<br />");
	}else{
		if (mysqli_connect_errno()) {
			echo("Connect failed: ".mysqli_connect_error()."<br />");
		} else {
			echo("Host information: ".mysqli_get_host_info($db)."<br />");
		}
	}
}
?>