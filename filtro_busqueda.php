<?php

////////////////// CONEXION A LA BASE DE DATOS ////////////////////////////////////

$host="localhost";
$usuario="root";
$contraseña="";
$base="centromedico";

$conexion= new mysqli($host, $usuario, $contraseña, $base);
if ($conexion -> connect_errno)
{
	die("Fallo la conexion:(".$conexion -> mysqli_connect_errno().")".$conexion-> mysqli_connect_error());
}
////////////////// VARIABLES DE CONSULTA////////////////////////////////////

$where="";
$nombre=$_POST['xnombre'];
$carrera=$_POST['xcarrera'];
$limit=$_POST['xregistros'];

////////////////////// BOTON BUSCAR //////////////////////////////////////

if (isset($_POST['buscar']))
{

	if (empty($_POST['xcarrera']))
	{
		$where="where nombre like '".$nombre."%'";
	}

	else if (empty($_POST['xnombre']))
	{
		$where="where carrera='".$carrera."'";
	}

	else
	{
		$where="where nombre like '".$nombre."%' and carrera='".$carrera."'";
	}
}
/////////////////////// CONSULTA A LA BASE DE DATOS ////////////////////////

$alumnos="SELECT * FROM alumnos $where $limit";
$resAlumnos=$conexion->query($alumnos);
$resCarreras=$conexion->query($alumnos);

if(mysqli_num_rows($resAlumnos)==0)
{
	$mensaje="<h1>No hay registros que coincidan con su criterio de búsqueda.</h1>";
}
?>
<html lang="es">
	
<body>
<?php include 'vista/plantillas/header.php'; ?>
    <section class="main">
        <div class="wrapp">
            <?php include 'vista/plantillas/nav.php'; ?>
            <article>
                <div class="mensaje">
                    <h2>REPORTERÍA</h2>
                </div>
		<section>
			<form method="post">
				<input type="text" placeholder="Nombre..." name="xnombre"/>
				<select name="xcarrera">
					<option value="">Carrera </option>
					<?
						while ($registroCarreras = $resCarreras->fetch_array(MYSQLI_BOTH))
						{
							echo '<option value="'.$registroCarreras['carrera'].'">'.$registroCarreras['carrera'].'</option>';
						}
					?>
				</select>

				<select name="xregistros">
					<option value="">No. de Registros</option>
					<option value="limit 3">3</option>
					<option value="limit 6">6</option>
					<option value="limit 9">9</option>
				</select>
				<button name="buscar" type="submit">Buscar</button>
			</form>

			<table class="tabla">
				<tr>
				<th>#</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Cliente</th>
                        <th>Terapista</th>
                        <th>Consultorio</th>
                        <th>Observaciones</th>
                        <th>Estado</th>
				</tr>

				<?php

				while ($registroAlumnos = $resAlumnos->fetch_array(MYSQLI_BOTH))
				{

					echo'<tr>
						 <td>'.$registroAlumnos['id_alumno'].'</td>
						 <td>'.$registroAlumnos['nombre'].'</td>
						 <td>'.$registroAlumnos['carrera'].'</td>
						 <td>'.$registroAlumnos['grupo'].'</td>
						 </tr>';
				}
				?>
			</table>

			<?
				echo $mensaje;
			?>
		</section>
	</body>
</html>


