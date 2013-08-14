<?php
session_start();
include("functions.php");
include("db.php");
include("userclass.php");
	$user=new user_class();
	$user->db=$db;
	
	// Define system VALUES
	define("_domain", 'localhost' );
	define("_sitepath", '/PHP/Learning-Register-Script/' );
	
?>