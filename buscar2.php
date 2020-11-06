<?php
	$servername = "localhost";
    $username = "root";
  	$password = "";
  	$dbname = "centromedico";

	$conn = new mysqli($servername, $username, $password, $dbname);
      if($conn->connect_error){
        die("Conexión fallida: ".$conn->connect_error);
      }

    $salida = "";

$query = "SELECT * FROM pacientes ORDER BY estado, pacApellidos LIMIT 25";

    if (isset($_POST['consulta'])) {
    	$q = $conn->real_escape_string($_POST['consulta']);
    	$query = "SELECT * FROM pacientes 
		WHERE pacIdentificacion LIKE '%".$q."%' OR pacNombre LIKE '%".$q."%' OR pacApellidos LIKE '%".$q."%'";
    }

    $resultado = $conn->query($query);

    if ($resultado->num_rows>0) {
		$salida.="<div id='div1'>
		<table class='tabla'>
		<thead>
    		<tr>
    					<td>#</td>
    					<td>Cédula</td>
    					<td>Nombre</td>
    					<td>Apellido</td>
						<td>Fecha de nacimiento</td>
						<td>Sexo</td>
						<td>Teléfono</td>
						<td>Dirección</td>
						<td>Estado</td>
						<th colspan='2'>Opciones</th>
    		</tr>
		</thead>";
    	while ($fila = $resultado->fetch_assoc()) {
    		$salida.="<tr>
    					<td class='mayusculas'>".$fila['idPaciente']."</td>
    					<td class='mayusculas'>".$fila['pacIdentificacion']."</td>
    					<td class='mayusculas'>".$fila['pacNombre']."</td>
						<td class='mayusculas'>".$fila['pacApellidos']."</td>
						<td class='mayusculas'>".$fila['pacFechaNacimiento']."</td>
						<td class='mayusculas'>".$fila['pacSexo']."</td>
						<td class='mayusculas'>".$fila['pacTelefono']."</td>
						<td class='mayusculas' style='word-break: break-all; width: 200px; white-space: initial'>".$fila['pacDireccion']."</td>
						<td class='mayusculas'>".$fila['estado']."</td>
						<td class='centrar'>"."<a href='actualizarpaciente.php?idPaciente=".$fila['idPaciente']."' class='editar'>Editar</a>". "</td>
						<td class='centrar'>"."<a href='eliminar_paciente.php?idPaciente=".$fila['idPaciente']."' class='eliminar'>Eliminar</a>". "</td>
						</tr>";
				 	}
    	$salida.="</table></div>";
    }else{
    	$salida.="NO HAY DATOS QUE COINCIDAN A SU CONSULTA...";
    }
    echo $salida;

    $conn->close();

	
?>