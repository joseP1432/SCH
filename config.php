<?php
	session_start();
	$endereco = "localhost";
	$usuario = "root";
	$senha = "";
	$banco = "DB_SCH";

	$MySQLi = new mysqli($endereco, $usuario, $senha, $banco, 3306);
	if(mysqli_connect_errno()){
		die(mysqli_connect_error());
		exit();
	}
	mysqli_set_charset($MySQLi,"utf8");

	function br_us($data) {
		$data = implode("-",array_reverse(explode("/",$data)));
		return $data;
	}
	function us_br($data) {
		$data = implode("/",array_reverse(explode("-",$data)));
		return $data;
	}
?>