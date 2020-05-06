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
                <h2>REPORTERÍA</h2>
            </div>
            <div class="wrapp">
                <center>

                    <label>Fecha:</label>
                    <input type="hidden" name="citas" value="<?php echo $cita['idcita'];?>">
                    <input type="date" name="fecha" placeholder="Fecha:" value="<?php echo $cita['citfecha'];?>" />

                    <label>Cliente: </label>
                    <select name="x_paciente" class="mayusculas">
                        <option value="<?php echo $cita['citPaciente'];?>">Ninguno...</option>
                        <?php foreach ($consulta as $Sql): ?>
                        <?php echo "<option value='". $Sql['citPaciente']."'>". $Sql['citPaciente']."</option>"; ?>
                        <?php endforeach; ?>
                    </select>

                    <label>Terapista: </label>
                    <select name="x_medico" class="mayusculas">
                        <option value="<?php echo $cita['citMedico'];?>">Ninguno...</option>
                        <?php foreach ($consulta as $Sql): ?>
                        <?php echo "<option value='". $Sql['citMedico']."'>". $Sql['citMedico']."</option>"; ?>
                        <?php endforeach; ?>
                    </select>
                    <a href="" class="agregar" target="reporte_vista.php"><img src="img/buscar.png" alt="imagen buscar"
                            width="15" height="15"></a>
                    <a href="generar_reporte.php" class="agregar" target="_blank">Generar reporte</a>

                </center>
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
                        <th>Observaciones</th>
                        <th>Estado</th>
                    </tr>
                    <?php foreach ($consulta as $Sql): ?>
                    <tr>
                        <?php echo "<td class='mayusculas'>". $Sql['idcita']. "</td>"; ?>
                        <?php echo "<td class='mayusculas'>". $Sql['citfecha']. "</td>"; ?>
                        <?php echo "<td class='mayusculas'>". $Sql['cithora']. "</td>"; ?>
                        <?php echo "<td class='mayusculas'>". $Sql['citPaciente']. "</td>"; ?>
                        <?php echo "<td class='mayusculas'>". $Sql['citMedico']. "</td>"; ?>
                        <?php echo "<td class='mayusculas'>". $Sql['citEspecialidades']. "</td>"; ?>
                        <?php echo "<td class='mayusculas'>". $Sql['citConsultorio']. "</td>"; ?>
                        <?php echo "<td class='mayusculas'>". $Sql['citobservaciones']. "</td>"; ?>
                        <?php echo "<td class='mayusculas'>". $Sql['citestado']. "</td>"; ?>
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
</body>

</html>