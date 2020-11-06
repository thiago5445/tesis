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

$query = "SELECT * FROM medicos ORDER BY estado, medapellidos LIMIT 25";

    if (isset($_POST['consulta'])) {
    	$q = $conn->real_escape_string($_POST['consulta']);
    	$query = "SELECT * FROM medicos 
		WHERE medidentificacion LIKE '%".$q."%' OR mednombres LIKE '%".$q."%' OR medapellidos LIKE '%".$q."%'";
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
						<td>Teléfono</td>
						<td>Correo electronico</td>
						<td>Servicio</td>
						<td>Estado</td>
						<th colspan='2'>Opciones</th>
    		</tr>
		</thead>";
    	while ($fila = $resultado->fetch_assoc()) {
    		$salida.="<tr>
    					<td class='mayusculas'>".$fila['idMedico']."</td>
    					<td class='mayusculas'>".$fila['medidentificacion']."</td>
    					<td class='mayusculas'>".$fila['mednombres']."</td>
    					<td class='mayusculas'>".$fila['medapellidos']."</td>
						<td class='mayusculas'>".$fila['medtelefono']."</td>
						<td class='mayusculas'>".$fila['medcorreo']."</td>
						<td class='mayusculas'>".$fila['medEspecialidad']."</td>
						<td class='mayusculas'>".$fila['estado']."</td>
						<td class='centrar'>"."<a href='actualizarmedico.php?idMedico=".$fila['idMedico']."' class='editar'>Editar</a>". "</td>
						<td class='centrar'>"."<a href='eliminar_medico.php?idMedico=".$fila['idMedico']."' class='eliminar'>Eliminar</a>". "</td>
						</tr>";
				 	}
    	$salida.="</table></div>";
    }else{
    	$salida.="NO HAY DATOS QUE COINCIDAN A SU CONSULTA...";
    }
    echo $salida;

    $conn->close();

	
?>