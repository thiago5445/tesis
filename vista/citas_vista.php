<?php
$mensaje='';
try{
	$conexion = new PDO('mysql:host=localhost;dbname=centromedico','root','');
}catch(PDOException $e){
	echo "Error: ". $e->getMessage();
}

$consulta = $conexion -> prepare("SELECT * FROM citas order by idcita");
$consulta ->execute();
$consulta = $consulta ->fetchAll();
if(!$consulta){
	$mensaje .= 'NO HAY CITAS PARA MOSTRAR';
}
?>
<?php include 'plantillas/header.php'; ?>
<section class="main">
    <div class="wrapp">
        <?php include 'plantillas/nav.php'; ?>
        <article>
            <div class="mensaje">
                <h2>CITAS</h2>
            </div>
            <div class="formulario">
                <a class="agregar" href="agregarcitas.php">Agregar Citas</a>
            </div>
            <hr>
            <div id="div1">
                <table class="tabla">
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Cliente</th>
                        <th>Terapista</th>
                        <th>Servicio</th>
                        <th>Consultorio</th>
                        <th>Estado</th>
                        <th>Observaciones</th>
                        <th colspan="2">Opciones</th>
                    </tr>
                    <?php foreach ($consulta as $Sql):?>
                    <tr>
                        <?php echo "<td class='mayusculas'>". $Sql['idcita']. "</td>"; ?>
                        <?php echo "<td class='mayusculas'>". $Sql['citfecha']. "</td>"; ?>
                        <?php echo "<td class='mayusculas'>". $Sql['cithora']. "</td>"; ?>
                        <?php echo "<td class='mayusculas'>". $Sql['citPaciente']. "</td>"; ?>
                        <?php echo "<td class='mayusculas'>". $Sql['citMedico']. "</td>"; ?>
                        <?php echo "<td class='mayusculas'>". $Sql['citEspecialidades']. "</td>"; ?>
                        <?php echo "<td class='mayusculas'>". $Sql['citConsultorio']. "</td>"; ?>
                        <?php echo "<td class='mayusculas'>". $Sql['citestado']. "</td>"; ?>
                        <?php echo "<td class='mayusculas' style='word-break: break-all; width: 200px; white-space: initial'>". $Sql['citobservaciones']. "</td>"; ?>
                        <?php echo "<td class='centrar'>"."<a href='actualizarcitas.php?idcita=".$Sql['idcita']."' class='editar'>Editar</a>". "</td>"; ?>
                        <?php echo "<td class='centrar'>"."<a href='eliminar_citas.php?idcita=".$Sql['idcita']."' class='eliminar'>Eliminar</a>". "</td>"; ?>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <?php  if(!empty($mensaje)): ?>
            <ul>
                <?php echo $mensaje; ?>
            </ul>
            <?php  endif; ?>
        </article>
</section>
<?php include 'plantillas/footer.php'; ?>