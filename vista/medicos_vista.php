<?php
$mensaje='';
try{
	$conexion = new PDO('mysql:host=localhost;dbname=centromedico','root','');
}catch(PDOException $e){
	echo "Error: ". $e->getMessage();
}

$consulta = $conexion -> prepare("SELECT * FROM medicos ORDER BY medidentificacion");

$consulta ->execute();
$consulta = $consulta ->fetchAll();
if(!$consulta){
	$mensaje .= 'NO HAY TERAPISTAS PARA MOSTRAR';
}
?>
<?php include 'plantillas/header.php'; ?>
<section class="main">
    <div class="wrapp">
        <?php include 'plantillas/nav.php'; ?>
        <article>
            <div class="mensaje">
                <h2>TERAPISTA</h2>
            </div>
            <a href="agregarmedicos.php" class="agregar">Agregar Terapista</a>
            <table class="tabla">
                <tr>
                    <th>#</th>
                    <th>Cédula</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Teléfono</th>
                    <th>Correo electrónico</th>
                    <th>Servicio</th>
                    <th colspan="2">Opciones</th>
                </tr>
                <?php foreach ($consulta as $Sql): ?>
                <tr>
                    <?php echo "<td class='mayusculas'>". $Sql['idMedico']. "</td>"; ?>
                    <?php echo "<td class='mayusculas'>". $Sql['medidentificacion']. "</td>"; ?>
                    <?php echo "<td class='mayusculas'>". $Sql['mednombres']. "</td>"; ?>
                    <?php echo "<td class='mayusculas'>". $Sql['medapellidos']. "</td>"; ?>
                    <?php echo "<td class='mayusculas'>". $Sql['medtelefono']. "</td>"; ?>
                    <?php echo "<td>". $Sql['medcorreo']. "</td>"; ?>
                    <?php echo "<td >". $Sql['medEspecialidad']. "</td>"; ?>
                    <?php echo "<td class='centrar'>"."<a href='actualizarmedico.php?idMedico=".$Sql['idMedico']."' class='editar'>Editar</a>". "</td>"; ?>
                    <?php echo "<td class='centrar'>"."<a href='eliminar_medico.php?idMedico=".$Sql['idMedico']."' class='eliminar'>Eliminar</a>". "</td>"; ?>
                </tr>
                <?php endforeach; ?>
            </table>
            <?php  if(!empty($mensaje)): ?>
            <ul>
                <?php echo $mensaje; ?>
            </ul>
            <?php  endif; ?>
        </article>
</section>
<?php include 'plantillas/footer.php'; ?>
</body>

</html>