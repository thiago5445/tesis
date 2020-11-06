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
	$query = "SELECT * FROM citas ORDER BY citfecha DESC LIMIT 25";

    if (isset($_POST['consulta'])) {
    	$q = $conn->real_escape_string($_POST['consulta']);
    	$query = "SELECT * FROM citas 
		WHERE citPaciente LIKE '%".$q."%' OR citMedico LIKE '%".$q."%'OR citEspecialidades LIKE '%".$q."%'";
    }

    $resultado = $conn->query($query);

    if ($resultado->num_rows>0) {
		$salida.="<div id='div1'>
		<table class='tabla'>
		<thead>
    		<tr>
    					<td>#</td>
    					<td>Fecha</td>
    					<td>Hora</td>
    					<td>Cliente</td>
						<td>Terapista</td>
						<td>Servicio</td>
						<td>Consultorio</td>
						<td>Estado</td>
						<td>Observaciones</td>
						<th colspan='2'>Opciones</th>
    		</tr>
		</thead>";
    	while ($fila = $resultado->fetch_assoc()) {
    		$salida.="<tr>
    					<td class='mayusculas'>".$fila['idcita']."</td>
    					<td class='mayusculas'>".$fila['citfecha']."</td>
    					<td class='mayusculas'>".$fila['cithora']."</td>
    					<td class='mayusculas'>".$fila['citPaciente']."</td>
						<td class='mayusculas'>".$fila['citMedico']."</td>
						<td class='mayusculas'>".$fila['citEspecialidades']."</td>
						<td class='mayusculas'>".$fila['citConsultorio']."</td>
						<td class='mayusculas'>".$fila['citestado']."</td>
						<td class='mayusculas' style='word-break: break-all; width: 200px; white-space: initial'>".$fila['citobservaciones']."</td>
						<td class='centrar'>"."<a href='actualizarcitas.php?idcita=".$fila['idcita']."' class='editar'>Editar</a>". "</td>
						<td class='centrar'>"."<a href='eliminar_citas.php?idcita=".$fila['idcita']."' class='eliminar'>Eliminar</a>". "</td>
						</tr>";
				 	}
    	$salida.="</table></div>";
    }else{
    	$salida.="NO HAY DATOS QUE COINCIDAN A SU CONSULTA...";
    }
    echo $salida;

    $conn->close();

	
?>