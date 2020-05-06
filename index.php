<?php session_start();
if (isset($_SESSION['usuario'])){
	header('Location: CentroEstetico.php');
}else{
	header('Location: login.php');
}	
?>