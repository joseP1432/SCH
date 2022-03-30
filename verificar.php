<?php
if(!isset($_SESSION['codigo'])){
	session_start();
	header("Location: login.php");
}