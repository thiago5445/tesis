<?php session_start();
if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
}
?>
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
////////////////// VARIABLES DE CONSULTA///////////////////////////////////////////
$where = "";
@$paciente = $_POST['xc'];
@$terapista = $_POST['xt'];
@$limit = $_POST['xr'];
////////////////////// BOTON BUSCAR //////////////////////////////////////////////
if (isset($_POST['buscar']))
{
	if (empty($_POST['xt']))
	{
		$where="where citPaciente like '%".$paciente."%'";
	}

	else if (empty($_POST['xc']))
	{
		$where="where citMedico='".$terapista."'";
	}

	else
	{
		$where="where citPaciente like '%".$paciente."%' and citMedico='".$terapista."'";
	}
}
/////////////////////// CONSULTA A LA BASE DE DATOS /////////////////////////////

$sql="SELECT * FROM citas $where $limit";
$consulta_general=$conexion->query($sql);
$consulta_terapista=$conexion->query($sql);

if(mysqli_num_rows($consulta_general)==0)
{
	$mensaje="<h1>No hay registros que coincidan con su criterio de búsqueda.</h1>";
}
?>


<?php include 'vista/plantillas/header.php'; ?>
<section class="main">
    <div class="wrapp">
        <?php include 'vista/plantillas/nav.php'; ?>
        <article>
            <div class="mensaje">
                <h2>REPORTERÍA</h2>
            </div>
            <hr>
            <div class="formulario">
                <form method="POST" id="reporte">
                    <input type="text" placeholder="Buscar cliente..." name="xc" />
                    <select name="xt">
                        <option value="">Buscar terapista </option>
                        <?php
						while ($terapista = $consulta_terapista->fetch_array(MYSQLI_BOTH))
						{
							echo '<option value="'.$terapista['citMedico'].'">'.$terapista['citMedico'].'</option>';
						}
					?>
                    </select>
                    <select name="xr">
                        <option value="">No. de Registros</option>
                        <option value="limit 3">3</option>
                        <option value="limit 6">6</option>
                        <option value="limit 9">9</option>
                    </select>
                    <button name="buscar" type="submit">Buscar</button>
                    <a href="generar_reporte.php" class="agregar" target="_blank">Generar reporte</a>
                </form>


                <hr>
                <div id='div1'>
                    <table class="tabla">
                        <tr>
                            <th>#</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Cliente</th>
                            <th>Terapista</th>
                            <th>Servicio</th>
                            <th>Consultorio</th>
                            <th>Observaciones</th>
                            <th>Estado</th>
                        </tr>

                        <?php

				while ($consulta = $consulta_general->fetch_array(MYSQLI_BOTH))
				{
					echo'<tr>
						 <td>'.$consulta['idcita'].'</td>
						 <td>'.$consulta['citfecha'].'</td>
						 <td>'.$consulta['cithora'].'</td>
                         <td>'.$consulta['citPaciente'].'</td>
                         <td>'.$consulta['citMedico'].'</td>
                         <td>'.$consulta['citEspecialidades'].'</td>
                         <td>'.$consulta['citConsultorio'].'</td>
                         <td>'.$consulta['citobservaciones'].'</td>
                         <td>'.$consulta['citestado'].'</td>
						 </tr>';
				}
				?>
                    </table>
                </div>
                <?
				echo $mensaje;
			?>
            </div>
        </article>
    </div>
</section>
<?php include 'vista/plantillas/footer.php'; ?>