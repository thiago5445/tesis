<?php session_start();
	if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
	}
	
	require 'funciones.php';
	
	try{
		$conexion = new PDO('mysql:host=localhost;dbname=centromedico','root','');
	}catch(PDOException $e){
		echo "ERROR: " . $e->getMessge();
		die();
	}
	
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$id = limpiarDatos($_POST['id']);
		$identificacion = limpiarDatos($_POST['identificacion']);
		$nombres = limpiarDatos($_POST['nombres']);
		$apellidos = limpiarDatos($_POST['apellidos']);
		$fecha = limpiarDatos($_POST['fecha']);
		$sexo = limpiarDatos($_POST['sexo']);
		$telefono = limpiarDatos($_POST['telefono']);
		$direccion = limpiarDatos($_POST['direccion']);
								
		$statement = $conexion->prepare(
		"UPDATE pacientes SET 
		pacIdentificacion = :identificacion, 
		pacNombre =:nombres, 
		pacApellidos =:apellidos, 
		pacFechaNacimiento =:fecha, 
		pacSexo =:sexo,
		pacTelefono =:telefono,
		pacDireccion =:direccion
		WHERE idPaciente = :id");

		$statement ->execute(array(
        ':identificacion'=>$identificacion, 
		':nombres'=>$nombres, 
		':apellidos'=>$apellidos, 
		':fecha'=>$fecha, 
		':sexo'=>$sexo, 
		':telefono'=>$telefono, 
		':direccion'=>$direccion, 
		':id'=>$id
        ));
        header('Location: pacientes.php');
	}else{
		$id_paciente = id_numeros($_GET['idPaciente']);
		if(empty($id_paciente)){
			header('Location: pacientes.php');
		}
		$paciente = obtener_paciente_id($conexion,$id_paciente);
		
		if(!$paciente){
			header('Location: pacientes.php');
		}
		$paciente =$paciente[0];
	}
	require 'vista/actualizarpaciente_vista.php';
?>