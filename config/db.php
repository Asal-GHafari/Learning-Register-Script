<?php
//Connecting. . .
//$mysqli = mysqli_connect(“hostname”, “username”, “password”, “database”);
        $db = mysqli_connect(“localhost”, “root”, “”, “mg_test”);

	if (mysqli_connect_errno()) {
		printf(“Connect failed: %s\n”, mysqli_connect_error());
		exit();
	} else {
		printf(“Host information: %s\n”, mysqli_get_host_info($mysqli));
	}

?>