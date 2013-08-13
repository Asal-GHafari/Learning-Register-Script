<?php
session_start();
include("functions.php");
include("db.php");
include("userclass.php");
	$user=new user_class();
	$user->db=$db;
	
?>