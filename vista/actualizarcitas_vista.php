<?php
$mensaje='';
try{
	$conexion = new PDO('mysql:host=localhost;dbname=centromedico','root','');
}catch(PDOException $e){
	echo "Error: ". $e->getMessage();
}
//SELECT PARA MEDICOS
$medicos = $conexion -> prepare("SELECT * FROM medicos");

$medicos ->execute();
$medicos = $medicos ->fetchAll();
if(!$medicos)
    $mensaje .= 'No hay medicos, por favor registre primero! <br />';
//SELECT PARA SERVICIOS
$servicios = $conexion -> prepare("SELECT * FROM especialidades");
$servicios ->execute();
$servicios = $servicios ->fetchAll();
if(!$servicios)
    $mensaje .= 'No hay servicios, por favor registre primero! <br />';
    //SELECT PARA CONSULTORIOS
$consultorios = $conexion -> prepare("SELECT * FROM consultorios");
$consultorios ->execute();
$consultorios = $consultorios ->fetchAll();
if(!$consultorios)
	$mensaje .= 'No hay consultorios, por favor registre primero! <br />';
//SELECT PARA PACIENTES
$pacientes = $conexion -> prepare("SELECT * FROM pacientes");

$pacientes ->execute();
$pacientes = $pacientes ->fetchAll();
if(!$pacientes)
	$mensaje .= 'No hay pacientes, por favor registre primero! <br />';

?>
<?php include 'plantillas/header.php'; ?>
<section class="main">
    <div class="wrapp">
        <?php include 'plantillas/nav.php'; ?>
        <article>
            <div class="mensaje">
                <h2>CITAS</h2>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                <h2>Actualizar Citas</h2><BR>
                <label>Fecha:</label>
                <input type="hidden" name="id" value="<?php echo $cita['idcita'];?>" require />
                <input type="date" name="fecha" placeholder="Fecha:" value="<?php echo $cita['citfecha'];?>" required />
                <label>Hora:</label>
                <input type="time" name="hora" value="<?php echo $cita['cithora'];?>" max="20:00" min="10:00" step="60"
                    required>
                <label>Paciente:</label>
                <select name="paciente" class="mayusculas" required>
                    <option value="<?php echo $cita['citPaciente'];?>" require></option>
                    <?php foreach ($pacientes as $Sql2): ?>
                    <?php echo "<option value='". $Sql2['pacNombre']. "'>". $Sql2['pacNombre']." ". $Sql2['pacApellidos']."</option>"; ?>
                    <?php endforeach; ?>
                </select>
                <label>Terapista:</label>
                <select name="medico" class="mayusculas" required>
                    <option value="<?php echo $cita['citMedico'];?>" require></option>
                    <?php foreach ($medicos as $Sql): ?>
                    <?php echo "<option value='". $Sql['mednombres']. "'>". $Sql['mednombres']." ". $Sql['medapellidos']."</option>"; ?>
                    <?php endforeach; ?>
                </select>
                <label>Servicios:</label>
                <select name="servicio" class="mayusculas" required>
                    <option value="<?php echo $cita['citEspecialidades'];?>" require></option>
                    <?php foreach ($servicios as $Sql2): ?>
                    <?php echo "<option value='". $Sql2['espNombre']. "'>". $Sql2['espNombre']."</option>"; ?>
                    <?php endforeach; ?>
                </select>
                <label>Consultorio:</label>
                <select name="consultorio" class="mayusculas" required>
                    <option value="<?php echo $cita['citConsultorio'];?>" require></option>
                    <?php foreach ($consultorios as $Sql2): ?>
                    <?php echo "<option value='". $Sql2['conNombre']. "'>". $Sql2['conNombre']."</option>"; ?>
                    <?php endforeach; ?>
                </select>
                <label>Estado:</label required>
                <select name="estado" require>
                    <option>Selecciona una opción</option>
                    if (<?php echo $cita['citMedico'];?>){
                    <option value="pendiente">Pendiente</option>
                    <option value="atendido">Atendido</option>
                    }
                </select>
                <label>Observaciones:</label>
                <textarea placeholder="Observacion:" name="observaciones" ;>
                <?php echo $cita['citobservaciones'];?></textarea>
                <input type="submit" name="enviar" value="Actualizar cita">
            </form>
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